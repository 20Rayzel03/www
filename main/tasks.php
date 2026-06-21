<?php
require_once __DIR__ . '/assets/auth.php';
require_admin();
require_once __DIR__ . '/assets/db.php';
$pageTitle = 'Aufgabenboard';

function redirect_tasks(): void { header('Location: tasks.php'); exit; }
function clean_text(string $value, int $max = 255): string { return substr(trim($value), 0, $max); }
function priority_label(string $priority): string {
    return ['low' => 'Niedrig', 'normal' => 'Normal', 'high' => 'Hoch', 'urgent' => 'Dringend'][$priority] ?? 'Normal';
}

$success = '';
$error = '';

// Ensure default columns exist if the table is empty.
$count = $conn->query('SELECT COUNT(*) AS c FROM task_columns')->fetch_assoc()['c'] ?? 0;
if ((int)$count === 0) {
    $defaults = ['Neu', 'In Arbeit', 'Warten auf Kunde', 'Material offen', 'Erledigt'];
    $stmt = $conn->prepare('INSERT INTO task_columns (title, position) VALUES (?, ?)');
    foreach ($defaults as $i => $title) {
        $pos = $i + 1;
        $stmt->bind_param('si', $title, $pos);
        $stmt->execute();
    }
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'create_column') {
        $title = clean_text($_POST['title'] ?? '', 80);
        if ($title === '') { $error = 'Bitte einen Spaltennamen angeben.'; }
        else {
            $pos = (int)($conn->query('SELECT COALESCE(MAX(position),0)+1 AS next_pos FROM task_columns')->fetch_assoc()['next_pos'] ?? 1);
            $stmt = $conn->prepare('INSERT INTO task_columns (title, position) VALUES (?, ?)');
            $stmt->bind_param('si', $title, $pos);
            $stmt->execute();
            $stmt->close();
            redirect_tasks();
        }
    }

    if ($action === 'rename_column') {
        $id = (int)($_POST['column_id'] ?? 0);
        $title = clean_text($_POST['title'] ?? '', 80);
        if ($id > 0 && $title !== '') {
            $stmt = $conn->prepare('UPDATE task_columns SET title = ? WHERE id = ?');
            $stmt->bind_param('si', $title, $id);
            $stmt->execute();
            $stmt->close();
        }
        redirect_tasks();
    }

    if ($action === 'move_column') {
        $id = (int)($_POST['column_id'] ?? 0);
        $direction = $_POST['direction'] ?? '';
        if ($id > 0 && in_array($direction, ['left', 'right'], true)) {
            $orderedIds = [];
            $res = $conn->query('SELECT id FROM task_columns ORDER BY position, id');
            while ($row = $res->fetch_assoc()) { $orderedIds[] = (int)$row['id']; }
            $res->free();

            $index = array_search($id, $orderedIds, true);
            if ($index !== false) {
                $targetIndex = $direction === 'left' ? $index - 1 : $index + 1;
                if (isset($orderedIds[$targetIndex])) {
                    [$orderedIds[$index], $orderedIds[$targetIndex]] = [$orderedIds[$targetIndex], $orderedIds[$index]];
                    $stmt = $conn->prepare('UPDATE task_columns SET position = ? WHERE id = ?');
                    foreach ($orderedIds as $pos => $columnId) {
                        $position = $pos + 1;
                        $stmt->bind_param('ii', $position, $columnId);
                        $stmt->execute();
                    }
                    $stmt->close();
                }
            }
        }
        redirect_tasks();
    }

    if ($action === 'delete_column') {
        $id = (int)($_POST['column_id'] ?? 0);
        if ($id > 0) {
            $stmt = $conn->prepare('SELECT COUNT(*) AS c FROM tasks WHERE column_id = ? AND is_archived = 0');
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $hasTasks = (int)$stmt->get_result()->fetch_assoc()['c'];
            $stmt->close();
            if ($hasTasks > 0) { $error = 'Spalte kann nur gelöscht werden, wenn keine aktiven Aufgaben darin liegen.'; }
            else {
                $stmt = $conn->prepare('DELETE FROM task_columns WHERE id = ?');
                $stmt->bind_param('i', $id);
                $stmt->execute();
                $stmt->close();
                redirect_tasks();
            }
        }
    }

    if ($action === 'create_task') {
        $title = clean_text($_POST['title'] ?? '', 140);
        $customer = clean_text($_POST['customer'] ?? '', 140);
        $description = trim($_POST['description'] ?? '');
        $notes = trim($_POST['notes'] ?? '');
        $priority = $_POST['priority'] ?? 'normal';
        $allowedPriorities = ['low','normal','high','urgent'];
        if (!in_array($priority, $allowedPriorities, true)) { $priority = 'normal'; }
        $dueDate = trim($_POST['due_date'] ?? '');
        $dueDate = $dueDate === '' ? null : $dueDate;
        $columnId = (int)($_POST['column_id'] ?? 0);
        $createdBy = (int)$_SESSION['user_id'];

        if ($title === '') { $error = 'Bitte einen Auftragstitel angeben.'; }
        elseif ($columnId <= 0) { $error = 'Bitte eine Spalte auswählen.'; }
        else {
            $pos = (int)($conn->query('SELECT COALESCE(MAX(position),0)+1 AS next_pos FROM tasks WHERE column_id = ' . $columnId . ' AND is_archived = 0')->fetch_assoc()['next_pos'] ?? 1);
            $stmt = $conn->prepare('INSERT INTO tasks (column_id, title, customer, description, priority, due_date, notes, position, created_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
            $stmt->bind_param('issssssii', $columnId, $title, $customer, $description, $priority, $dueDate, $notes, $pos, $createdBy);
            $stmt->execute();
            $stmt->close();
            redirect_tasks();
        }
    }

    if ($action === 'update_task') {
        $taskId = (int)($_POST['task_id'] ?? 0);
        $title = clean_text($_POST['title'] ?? '', 140);
        $customer = clean_text($_POST['customer'] ?? '', 140);
        $description = trim($_POST['description'] ?? '');
        $notes = trim($_POST['notes'] ?? '');
        $priority = $_POST['priority'] ?? 'normal';
        $allowedPriorities = ['low','normal','high','urgent'];
        if (!in_array($priority, $allowedPriorities, true)) { $priority = 'normal'; }
        $dueDate = trim($_POST['due_date'] ?? '');
        $dueDate = $dueDate === '' ? null : $dueDate;
        $columnId = (int)($_POST['column_id'] ?? 0);

        if ($taskId > 0 && $title !== '' && $columnId > 0) {
            $stmt = $conn->prepare('UPDATE tasks SET column_id = ?, title = ?, customer = ?, description = ?, priority = ?, due_date = ?, notes = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ? AND is_archived = 0');
            $stmt->bind_param('issssssi', $columnId, $title, $customer, $description, $priority, $dueDate, $notes, $taskId);
            $stmt->execute();
            $stmt->close();
        }
        redirect_tasks();
    }

    if ($action === 'move_task') {
        $taskId = (int)($_POST['task_id'] ?? 0);
        $columnId = (int)($_POST['column_id'] ?? 0);
        if ($taskId > 0 && $columnId > 0) {
            $pos = (int)($conn->query('SELECT COALESCE(MAX(position),0)+1 AS next_pos FROM tasks WHERE column_id = ' . $columnId . ' AND is_archived = 0')->fetch_assoc()['next_pos'] ?? 1);
            $stmt = $conn->prepare('UPDATE tasks SET column_id = ?, position = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?');
            $stmt->bind_param('iii', $columnId, $pos, $taskId);
            $stmt->execute();
            $stmt->close();
        }
        redirect_tasks();
    }

    if ($action === 'archive_task') {
        $taskId = (int)($_POST['task_id'] ?? 0);
        if ($taskId > 0) {
            $stmt = $conn->prepare('UPDATE tasks SET is_archived = 1, updated_at = CURRENT_TIMESTAMP WHERE id = ?');
            $stmt->bind_param('i', $taskId);
            $stmt->execute();
            $stmt->close();
        }
        redirect_tasks();
    }
}

$columns = [];
$res = $conn->query('SELECT id, title, position FROM task_columns ORDER BY position, id');
while ($row = $res->fetch_assoc()) { $row['tasks'] = []; $columns[(int)$row['id']] = $row; }
$res->free();

$res = $conn->query('SELECT id, column_id, title, customer, description, priority, due_date, notes, created_at, updated_at FROM tasks WHERE is_archived = 0 ORDER BY column_id, position, id');
while ($task = $res->fetch_assoc()) {
    $cid = (int)$task['column_id'];
    if (isset($columns[$cid])) { $columns[$cid]['tasks'][] = $task; }
}
$res->free();

$columnCount = max(count($columns), 1);

include 'assets/header.php';
?>
<style>
  body.task-board-page { overflow-x: hidden; }
  body.task-board-page .page-hero,
  body.task-board-page .site-footer { display: none; }
  .task-shell { width: 100%; min-height: calc(100vh - 66px); padding: 18px 18px 22px; }
  .task-topbar { display: grid; grid-template-columns: 1fr auto; gap: 16px; align-items: center; margin-bottom: 14px; }
  .task-topbar h1 { font-size: clamp(28px, 2.4vw, 48px); margin: 0; }
  .task-topbar p { margin: 4px 0 0; color: var(--soft); }
  .task-topbar-actions { display: flex; gap: 10px; align-items: center; flex-wrap: wrap; justify-content: flex-end; }
  .task-alerts { max-width: 900px; }
  .task-column-tools { display: flex; gap: 10px; align-items: center; margin-bottom: 14px; }
  .task-column-tools input { min-width: 260px; }
  .task-board-full { display: grid; grid-template-columns: repeat(<?= (int)$columnCount ?>, minmax(0, 1fr)); gap: 0; min-height: calc(100vh - 190px); border: 1px solid var(--line); border-radius: 22px; overflow: hidden; background: rgba(0,0,0,.20); box-shadow: var(--shadow); }
  .task-board-column { min-width: 0; display: flex; flex-direction: column; border-right: 1px solid var(--line); background: linear-gradient(180deg, rgba(255,255,255,.035), rgba(255,255,255,.014)); }
  .task-board-column:last-child { border-right: 0; }
  .task-column-header { min-height: 92px; padding: 14px 16px; border-bottom: 1px solid var(--line); display: grid; grid-template-columns: minmax(0, 1fr) auto; gap: 10px 12px; align-items: center; background: rgba(255,255,255,.025); }
  .column-title-form { min-width: 0; }
  .task-column-header input { width: 100%; border: 0; background: transparent; padding: 6px 0; font-weight: 800; font-size: clamp(18px, 1.2vw, 26px); letter-spacing: -.03em; color: var(--text); }
  .task-column-header input:focus { border: 1px solid var(--line); background: rgba(255,255,255,.04); padding: 8px 10px; }
  .task-count { flex: 0 0 auto; display: grid; place-items: center; min-width: 32px; height: 32px; border-radius: 999px; background: rgba(94,106,210,.16); border: 1px solid rgba(130,143,255,.24); font-weight: 800; }
  .column-move-actions { grid-column: 1 / -1; display: flex; gap: 8px; align-items: center; justify-content: flex-start; }
  .column-move-actions form { margin: 0; }
  .column-move-actions button { border: 1px solid var(--line); background: rgba(255,255,255,.045); color: var(--soft); border-radius: 999px; padding: 6px 10px; font: inherit; font-size: 12px; cursor: pointer; transition: .16s ease; }
  .column-move-actions button:hover:not(:disabled) { color: var(--text); border-color: rgba(255,255,255,.2); background: rgba(255,255,255,.075); }
  .column-move-actions button:disabled { opacity: .35; cursor: not-allowed; }
  .task-column-body { flex: 1; padding: 18px; display: flex; flex-direction: column; gap: 14px; overflow-y: auto; }
  .task-column-footer { padding: 10px 16px 14px; border-top: 1px solid var(--line2); }
  .task-column-footer button { color: var(--soft); border: 0; background: transparent; cursor: pointer; font: inherit; font-size: 12px; }
  .task-empty { color: var(--soft); text-align: center; border: 1px dashed var(--line); border-radius: 16px; padding: 22px 10px; font-size: 13px; }
  .work-card { width: 100%; text-align: left; border: 1px solid var(--line); border-left: 4px solid rgba(130,143,255,.75); border-radius: 16px; color: var(--text); background: linear-gradient(180deg, rgba(255,255,255,.065), rgba(255,255,255,.03)); padding: 14px; cursor: pointer; box-shadow: 0 14px 34px rgba(0,0,0,.22); transition: .16s ease; }
  .work-card:hover { transform: translateY(-2px); border-color: rgba(255,255,255,.18); background: linear-gradient(180deg, rgba(255,255,255,.085), rgba(255,255,255,.04)); }
  .work-card.priority-low{border-left-color:#64748b}.work-card.priority-normal{border-left-color:#818cf8}.work-card.priority-high{border-left-color:#f59e0b}.work-card.priority-urgent{border-left-color:#ef4444}
  .work-card strong { display: block; font-size: clamp(15px, .92vw, 18px); line-height: 1.25; margin-bottom: 8px; }
  .work-card-meta { display: flex; flex-wrap: wrap; gap: 6px; align-items: center; color: var(--soft); font-size: 12px; }
  .work-card-pill { border: 1px solid var(--line); border-radius: 999px; padding: 3px 8px; background: rgba(255,255,255,.035); }
  .modal-backdrop { position: fixed; inset: 0; z-index: 500; display: none; align-items: center; justify-content: center; padding: 30px; background: rgba(0,0,0,.72); backdrop-filter: blur(14px); }
  .modal-backdrop.is-open { display: flex; }
  .task-modal { width: min(920px, 94vw); max-height: 90vh; overflow: auto; border: 1px solid var(--line); border-radius: 24px; background: linear-gradient(180deg, rgba(18,20,24,.98), rgba(10,11,13,.98)); box-shadow: 0 30px 90px rgba(0,0,0,.55); padding: 24px; }
  .task-modal-head { display: flex; align-items: start; justify-content: space-between; gap: 16px; margin-bottom: 18px; }
  .task-modal-head h2 { margin: 0; font-size: clamp(24px, 2vw, 36px); }
  .modal-close { border: 1px solid var(--line); background: rgba(255,255,255,.04); color: var(--text); border-radius: 12px; width: 42px; height: 42px; cursor: pointer; font-size: 24px; line-height: 1; }
  .modal-form { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 14px; }
  .modal-form .wide { grid-column: 1 / -1; }
  .modal-form textarea { min-height: 120px; }
  .modal-actions { grid-column: 1 / -1; display: flex; justify-content: space-between; gap: 12px; align-items: center; margin-top: 4px; flex-wrap: wrap; }
  .danger-inline button { border: 0; background: transparent; color: #fca5a5; font: inherit; cursor: pointer; padding: 0; }
  @media (max-width: 1200px) { .task-board-full { overflow-x: auto; grid-template-columns: repeat(<?= (int)$columnCount ?>, minmax(250px, 1fr)); } }
</style>
<header class="page-hero"><div class="container"><span class="eyebrow">Admin</span><h1>Aufgabenboard</h1></div></header>
<main class="task-shell">
  <div class="task-topbar">
    <div>
      <span class="eyebrow">Admin</span>
      <h1>Aufgabenboard</h1>
      <p>Monitor-Ansicht: alle Spalten teilen sich die komplette Breite gleichmäßig auf.</p>
    </div>
    <div class="task-topbar-actions">
      <button class="btn btn-primary" type="button" data-open-modal="newTaskModal">+ Neue Aufgabe</button>
      <a class="btn btn-ghost" href="dashboard.php">← Dashboard</a>
    </div>
  </div>

  <div class="task-alerts">
    <?php if ($error): ?><div class="alert error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
    <?php if ($success): ?><div class="alert ok"><?= htmlspecialchars($success) ?></div><?php endif; ?>
  </div>

  <form method="post" class="task-column-tools">
    <input type="hidden" name="action" value="create_column">
    <input name="title" placeholder="Neue Spalte, z. B. Rückfrage offen" required>
    <button class="btn btn-ghost" type="submit">Spalte hinzufügen</button>
  </form>

  <section class="task-board-full" aria-label="Aufgabenboard">
    <?php $columnIndex = 0; $lastColumnIndex = count($columns) - 1; ?>
    <?php foreach ($columns as $column): ?>
      <article class="task-board-column">
        <div class="task-column-header">
          <form method="post" class="column-title-form">
            <input type="hidden" name="action" value="rename_column">
            <input type="hidden" name="column_id" value="<?= (int)$column['id'] ?>">
            <input name="title" value="<?= htmlspecialchars($column['title']) ?>" aria-label="Spaltenname" onchange="this.form.submit()">
          </form>
          <span class="task-count"><?= count($column['tasks']) ?></span>
          <div class="column-move-actions" aria-label="Spalte verschieben">
            <form method="post">
              <input type="hidden" name="action" value="move_column">
              <input type="hidden" name="column_id" value="<?= (int)$column['id'] ?>">
              <input type="hidden" name="direction" value="left">
              <button type="submit" <?= $columnIndex === 0 ? 'disabled' : '' ?>>← nach links</button>
            </form>
            <form method="post">
              <input type="hidden" name="action" value="move_column">
              <input type="hidden" name="column_id" value="<?= (int)$column['id'] ?>">
              <input type="hidden" name="direction" value="right">
              <button type="submit" <?= $columnIndex === $lastColumnIndex ? 'disabled' : '' ?>>nach rechts →</button>
            </form>
          </div>
        </div>
        <div class="task-column-body">
          <?php if (!$column['tasks']): ?><p class="task-empty">Noch keine Aufgaben.</p><?php endif; ?>
          <?php foreach ($column['tasks'] as $task): ?>
            <?php
              $descPreview = trim((string)$task['description']);
              if (strlen($descPreview) > 120) { $descPreview = substr($descPreview, 0, 117) . '...'; }
            ?>
            <button type="button"
              class="work-card priority-<?= htmlspecialchars($task['priority']) ?>"
              data-open-task
              data-id="<?= (int)$task['id'] ?>"
              data-title="<?= htmlspecialchars($task['title']) ?>"
              data-customer="<?= htmlspecialchars($task['customer'] ?? '') ?>"
              data-description="<?= htmlspecialchars($task['description'] ?? '') ?>"
              data-priority="<?= htmlspecialchars($task['priority']) ?>"
              data-due-date="<?= htmlspecialchars($task['due_date'] ?? '') ?>"
              data-notes="<?= htmlspecialchars($task['notes'] ?? '') ?>"
              data-column-id="<?= (int)$task['column_id'] ?>">
              <strong><?= htmlspecialchars($task['title']) ?></strong>
              <span class="work-card-meta">
                <?php if ($task['customer']): ?><span class="work-card-pill">🏷️ <?= htmlspecialchars($task['customer']) ?></span><?php endif; ?>
                <span class="work-card-pill"><?= htmlspecialchars(priority_label($task['priority'])) ?></span>
                <?php if ($task['due_date']): ?><span class="work-card-pill">📅 <?= htmlspecialchars(date('d.m.Y', strtotime($task['due_date']))) ?></span><?php endif; ?>
              </span>
              <?php if ($descPreview): ?><span style="display:block;color:var(--muted);font-size:13px;margin-top:9px;"><?= nl2br(htmlspecialchars($descPreview)) ?></span><?php endif; ?>
            </button>
          <?php endforeach; ?>
        </div>
        <form method="post" class="task-column-footer" onsubmit="return confirm('Leere Spalte wirklich löschen?')">
          <input type="hidden" name="action" value="delete_column">
          <input type="hidden" name="column_id" value="<?= (int)$column['id'] ?>">
          <button type="submit">Leere Spalte löschen</button>
        </form>
      </article>
      <?php $columnIndex++; ?>
    <?php endforeach; ?>
  </section>
</main>

<div class="modal-backdrop" id="newTaskModal" role="dialog" aria-modal="true" aria-labelledby="newTaskTitle">
  <section class="task-modal">
    <div class="task-modal-head">
      <div><h2 id="newTaskTitle">Neuen Auftrag erfassen</h2><p class="muted">Dieses Fenster öffnet sich über „Neue Aufgabe“.</p></div>
      <button class="modal-close" type="button" data-close-modal aria-label="Schließen">×</button>
    </div>
    <form method="post" class="modal-form">
      <input type="hidden" name="action" value="create_task">
      <div><label>Titel *</label><input name="title" placeholder="z. B. A 123 412" required></div>
      <div><label>Kunde / Objekt</label><input name="customer" placeholder="z. B. Kunde, Standort, Fahrzeug"></div>
      <div><label>Status</label><select name="column_id"><?php foreach ($columns as $column): ?><option value="<?= (int)$column['id'] ?>"><?= htmlspecialchars($column['title']) ?></option><?php endforeach; ?></select></div>
      <div><label>Priorität</label><select name="priority"><option value="low">Niedrig</option><option value="normal" selected>Normal</option><option value="high">Hoch</option><option value="urgent">Dringend</option></select></div>
      <div><label>Fällig am</label><input type="date" name="due_date"></div>
      <div class="wide"><label>Beschreibung</label><textarea name="description" placeholder="Was ist zu erledigen?"></textarea></div>
      <div class="wide"><label>Notizen</label><textarea name="notes" placeholder="Material, Rückfragen, wichtige Infos ..."></textarea></div>
      <div class="modal-actions"><span></span><button class="btn btn-primary" type="submit">Auftrag anlegen</button></div>
    </form>
  </section>
</div>

<div class="modal-backdrop" id="taskDetailModal" role="dialog" aria-modal="true" aria-labelledby="taskDetailTitle">
  <section class="task-modal">
    <div class="task-modal-head">
      <div><h2 id="taskDetailTitle">Aufgabe bearbeiten</h2><p class="muted">Dieses Fenster öffnet sich beim Klick auf eine Kachel.</p></div>
      <button class="modal-close" type="button" data-close-modal aria-label="Schließen">×</button>
    </div>
    <form method="post" class="modal-form" id="taskEditForm">
      <input type="hidden" name="action" value="update_task">
      <input type="hidden" name="task_id" id="editTaskId">
      <div><label>Titel *</label><input name="title" id="editTitle" required></div>
      <div><label>Kunde / Objekt</label><input name="customer" id="editCustomer"></div>
      <div><label>Status</label><select name="column_id" id="editColumnId"><?php foreach ($columns as $column): ?><option value="<?= (int)$column['id'] ?>"><?= htmlspecialchars($column['title']) ?></option><?php endforeach; ?></select></div>
      <div><label>Priorität</label><select name="priority" id="editPriority"><option value="low">Niedrig</option><option value="normal">Normal</option><option value="high">Hoch</option><option value="urgent">Dringend</option></select></div>
      <div><label>Fällig am</label><input type="date" name="due_date" id="editDueDate"></div>
      <div class="wide"><label>Beschreibung</label><textarea name="description" id="editDescription"></textarea></div>
      <div class="wide"><label>Notizen</label><textarea name="notes" id="editNotes"></textarea></div>
      <div class="modal-actions">
        <button class="btn btn-primary" type="submit">Änderungen speichern</button>
        <button class="btn btn-ghost" type="submit" form="taskArchiveForm" onclick="return confirm('Aufgabe wirklich archivieren?')">Archivieren</button>
      </div>
    </form>
    <form method="post" id="taskArchiveForm">
      <input type="hidden" name="action" value="archive_task">
      <input type="hidden" name="task_id" id="archiveTaskId">
    </form>
  </section>
</div>

<script>
  document.body.classList.add('task-board-page');

  const openModal = (modal) => {
    if (!modal) return;
    modal.classList.add('is-open');
    const firstInput = modal.querySelector('input:not([type="hidden"]), textarea, select, button');
    if (firstInput) setTimeout(() => firstInput.focus(), 50);
  };
  const closeModal = (modal) => { if (modal) modal.classList.remove('is-open'); };

  document.querySelectorAll('[data-open-modal]').forEach((btn) => {
    btn.addEventListener('click', () => openModal(document.getElementById(btn.dataset.openModal)));
  });

  document.querySelectorAll('[data-close-modal]').forEach((btn) => {
    btn.addEventListener('click', () => closeModal(btn.closest('.modal-backdrop')));
  });

  document.querySelectorAll('.modal-backdrop').forEach((modal) => {
    modal.addEventListener('click', (event) => { if (event.target === modal) closeModal(modal); });
  });

  document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') document.querySelectorAll('.modal-backdrop.is-open').forEach(closeModal);
  });

  document.querySelectorAll('[data-open-task]').forEach((card) => {
    card.addEventListener('click', () => {
      document.getElementById('editTaskId').value = card.dataset.id || '';
      document.getElementById('archiveTaskId').value = card.dataset.id || '';
      document.getElementById('editTitle').value = card.dataset.title || '';
      document.getElementById('editCustomer').value = card.dataset.customer || '';
      document.getElementById('editDescription').value = card.dataset.description || '';
      document.getElementById('editPriority').value = card.dataset.priority || 'normal';
      document.getElementById('editDueDate').value = card.dataset.dueDate || '';
      document.getElementById('editNotes').value = card.dataset.notes || '';
      document.getElementById('editColumnId').value = card.dataset.columnId || '';
      openModal(document.getElementById('taskDetailModal'));
    });
  });
</script>
<?php include 'assets/footer.php'; ?>
