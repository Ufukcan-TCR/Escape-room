// Gemaakt door: Nizar
const TIMER_MINUTES = 5;


const answered = {};
let timerInterval = null;
let secondsLeft = TIMER_MINUTES * 60;

function startTimer() {
  updateTimerDisplay();
  timerInterval = setInterval(() => {
    secondsLeft--;
    updateTimerDisplay();
    if (secondsLeft <= 0) {
      clearInterval(timerInterval);
      closeModal();
      window.location.href = '../Verliesscherm.php';
    }
  }, 1000);
}

function updateTimerDisplay() {
  const mins = String(Math.floor(secondsLeft / 60)).padStart(2, '0');
  const secs = String(secondsLeft % 60).padStart(2, '0');
  const display = document.getElementById('timer-display');
  if (display) {
    display.innerText = `⏱ ${mins}:${secs}`;
    display.style.color = secondsLeft <= 30 ? '#ff4444' : '#1AE49A';
  }
}

function openModal(roomId, index) {
  const boxId = `${roomId}-${index}`;
  if (answered[boxId]) return;

  const box = document.getElementById(`box-${boxId}`);
  document.getElementById('riddle').innerText = box.dataset.riddle;

  const modalImg = document.getElementById('modal-img');
  modalImg.src = box.dataset.img || '';
  modalImg.alt = box.dataset.imgAlt || '';

  const modal = document.getElementById('modal');
  modal.dataset.answer = box.dataset.answer;
  modal.dataset.room = roomId;
  modal.dataset.index = index;

  document.getElementById('answer').value = '';
  document.getElementById('feedback').innerText = '';

  document.getElementById('overlay').style.display = 'block';
  modal.style.display = 'block';

  setTimeout(() => document.getElementById('answer').focus(), 50);
}

function closeModal() {
  document.getElementById('overlay').style.display = 'none';
  document.getElementById('modal').style.display = 'none';
  document.getElementById('feedback').innerText = '';
}

function checkAnswer() {
  const userAnswer = document.getElementById('answer').value.trim();
  const modal = document.getElementById('modal');
  const correctAnswer = modal.dataset.answer;
  const roomId = modal.dataset.room;
  const index = modal.dataset.index;
  const boxId = `${roomId}-${index}`;
  const feedback = document.getElementById('feedback');

  if (userAnswer.toLowerCase() === correctAnswer.toLowerCase()) {
    feedback.innerText = '✅';
    answered[boxId] = true;

    setTimeout(() => {
      const box = document.getElementById(`box-${boxId}`);
      const icon = document.getElementById(`icon-${boxId}`);
      box.classList.add('answered-correct');
      box.onclick = null;
      icon.innerText = '✅';
      closeModal();
    }, 700);
  } else {
    feedback.innerText = '❌ Fout! Probeer opnieuw.';
    document.getElementById('answer').value = '';
    document.getElementById('answer').focus();
  }
}

if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', startTimer);
} else {
  startTimer();
}