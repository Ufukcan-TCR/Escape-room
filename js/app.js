// Gemaakt door: Nizar

const TIMER_MINUTES = 5;
const TOTAL_SECONDS = TIMER_MINUTES * 60;

const roomMatch = window.location.pathname.match(/room-(\d+)\.php/);
const currentRoom = roomMatch ? parseInt(roomMatch[1]) : 1;

function getCompleted() {
  try { return JSON.parse(localStorage.getItem('completedRooms') || '[]'); }
  catch { return []; }
}

function markRoomComplete(roomId) {
  const done = getCompleted();
  if (!done.includes(roomId)) {
    done.push(roomId);
    localStorage.setItem('completedRooms', JSON.stringify(done));
  }
}

function isRoomUnlocked(roomId) {
  if (roomId === 1) return true;
  return getCompleted().includes(roomId - 1);
}

if (!isRoomUnlocked(currentRoom)) {
  alert('Je moet eerst kamer ' + (currentRoom - 1) + ' voltooien!');
  window.location.replace('room-' + (currentRoom - 1) + '.php');
}

document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.room-nav a').forEach(link => {
    const m = link.href.match(/room-(\d+)\.php/);
    if (!m) return;
    const targetRoom = parseInt(m[1]);
    if (!isRoomUnlocked(targetRoom)) {
      link.style.pointerEvents = 'none';
      link.style.opacity = '0.4';
      link.title = 'Voltooi kamer ' + (targetRoom - 1) + ' eerst';
      link.textContent += ' 🔒';
    }
  });
});

function getEndTime() {
  const stored = localStorage.getItem('timerEndTime');
  if (stored) return parseInt(stored);

  if (currentRoom === 1) {
    const endTime = Date.now() + TOTAL_SECONDS * 1000;
    localStorage.setItem('timerEndTime', endTime);
    return endTime;
  }

  alert('Je sessie is verlopen. Begin opnieuw bij kamer 1.');
  localStorage.removeItem('completedRooms');
  window.location.replace('room-1.php');
  return Date.now(); // fallback, wordt niet gebruikt
}

let timerInterval = null;

function startTimer() {
  updateTimerDisplay();
  timerInterval = setInterval(() => {
    const secondsLeft = Math.floor((getEndTime() - Date.now()) / 1000);
    updateTimerDisplay(secondsLeft);
    if (secondsLeft <= 0) {
      clearInterval(timerInterval);
      localStorage.removeItem('timerEndTime');
      localStorage.removeItem('completedRooms');
      closeModal();
      window.location.href = '../Verliesscherm.php';
    }
  }, 500);
}

function updateTimerDisplay(secondsLeft) {
  if (secondsLeft === undefined) {
    secondsLeft = Math.floor((getEndTime() - Date.now()) / 1000);
  }
  if (secondsLeft < 0) secondsLeft = 0;
  const mins = String(Math.floor(secondsLeft / 60)).padStart(2, '0');
  const secs = String(secondsLeft % 60).padStart(2, '0');
  const display = document.getElementById('timer-display');
  if (display) {
    display.innerText = `⏱ ${mins}:${secs}`;
    display.style.color = secondsLeft <= 30 ? '#ff4444' : '#1AE49A';
  }
}

function getAnsweredForRoom(roomId) {
  try { return JSON.parse(localStorage.getItem('answered_room_' + roomId) || '[]'); }
  catch { return []; }
}

function saveAnswered(roomId, index) {
  const list = getAnsweredForRoom(roomId);
  if (!list.includes(index)) {
    list.push(index);
    localStorage.setItem('answered_room_' + roomId, JSON.stringify(list));
  }
}


function openModal(roomId, index) {
  const boxId = `${roomId}-${index}`;

  // Al beantwoord? Niet openen.
  if (getAnsweredForRoom(roomId).includes(index)) return;

  const box = document.getElementById(`box-${boxId}`);
  document.getElementById('riddle').innerText = box.dataset.riddle;

  const modalImg = document.getElementById('modal-img');
  modalImg.src = box.dataset.img || '';
  modalImg.alt = box.dataset.imgAlt || '';

  const modal = document.getElementById('modal');
  modal.dataset.answer = box.dataset.answer;
  modal.dataset.room   = roomId;
  modal.dataset.index  = index;

  document.getElementById('answer').value = '';
  document.getElementById('feedback').innerText = '';

  document.getElementById('overlay').style.display = 'block';
  modal.style.display = 'block';

  setTimeout(() => document.getElementById('answer').focus(), 50);
}

function closeModal() {
  document.getElementById('overlay').style.display = 'none';
  document.getElementById('modal').style.display   = 'none';
  document.getElementById('feedback').innerText    = '';
}


function checkAnswer() {
  const userAnswer    = document.getElementById('answer').value.trim();
  const modal         = document.getElementById('modal');
  const correctAnswer = modal.dataset.answer;
  const roomId        = parseInt(modal.dataset.room);
  const index         = parseInt(modal.dataset.index);
  const boxId         = `${roomId}-${index}`;
  const feedback      = document.getElementById('feedback');

  if (userAnswer.toLowerCase() === correctAnswer.toLowerCase()) {
    feedback.innerText = '✅';
    saveAnswered(roomId, index);

    setTimeout(() => {
      const box  = document.getElementById(`box-${boxId}`);
      const icon = document.getElementById(`icon-${boxId}`);
      box.classList.add('answered-correct');
      box.onclick = null;
      icon.innerText = '✅';
      closeModal();

      const answeredCount = getAnsweredForRoom(roomId).length;

      if (answeredCount >= 3) {
        markRoomComplete(roomId);
        localStorage.removeItem('answered_room_' + roomId);

        setTimeout(() => {
          if (roomId < 3) {
            const nextRoom = roomId + 1;
            document.querySelectorAll('.room-nav a').forEach(link => {
              if (link.href.includes('room-' + nextRoom)) {
                link.style.pointerEvents = '';
                link.style.opacity = '';
                link.textContent = link.textContent.replace(' 🔒', '');
              }
            });
            if (confirm('🎉 Kamer ' + roomId + ' voltooid! Ga je naar kamer ' + nextRoom + '?')) {
              window.location.href = 'room-' + nextRoom + '.php';
            }
          } else {
            localStorage.removeItem('timerEndTime');
            localStorage.removeItem('completedRooms');
            window.location.href = '../Winscherm.php';
          }
        }, 600);
      }
    }, 700);

  } else {
    feedback.innerText = '❌ Fout! Probeer opnieuw.';
    document.getElementById('answer').value = '';
    document.getElementById('answer').focus();
  }
}


document.addEventListener('DOMContentLoaded', () => {
  const alreadyDone = getAnsweredForRoom(currentRoom);
  alreadyDone.forEach(index => {
    const boxId = `${currentRoom}-${index}`;
    const box   = document.getElementById(`box-${boxId}`);
    const icon  = document.getElementById(`icon-${boxId}`);
    if (box) {
      box.classList.add('answered-correct');
      box.onclick = null;
    }
    if (icon) icon.innerText = '✅';
  });
});


if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', startTimer);
} else {
  startTimer();
}