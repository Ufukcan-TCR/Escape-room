const answered = {};
 
function openModal(roomId, index) {
  const boxId = `${roomId}-${index}`;
  if (answered[boxId]) return; // Already answered, don't reopen
 
  const box = document.getElementById(`box-${boxId}`);
  const riddleText = box.dataset.riddle;
  const correctAnswer = box.dataset.answer;
 
  document.getElementById('riddle').innerText = riddleText;
 
  const modal = document.getElementById('modal');
  modal.dataset.answer = correctAnswer;
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
  const isCorrect = userAnswer.toLowerCase() === correctAnswer.toLowerCase();
 
  if (isCorrect) {
    feedback.innerText = '✅';
  } else {
    feedback.innerText = '❌';
  }
 
  setTimeout(() => {
    // Mark the box as answered
    answered[boxId] = true;
 
    const box = document.getElementById(`box-${boxId}`);
    const icon = document.getElementById(`icon-${boxId}`);
 
    if (isCorrect) {
      box.classList.add('answered-correct');
      icon.innerText = '✅';
    } else {
      box.classList.add('answered-wrong');
      icon.innerText = '❌';
    }
 
    box.onclick = null; // Disable further clicks
 
    closeModal();
  }, 800);
}