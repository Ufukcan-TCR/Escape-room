// TELLER
let score = 0;
let vragen = 0;

// Deze functie opent de modal en toont de vraag
function openModal(index) {
  let box = document.querySelector(`.box[data-index='${index}']`);
  let riddleText = box.dataset.riddle;
  let correctAnswer = box.dataset.answer;

  document.getElementById('riddle').innerText = riddleText;
  document.getElementById('modal').dataset.answer = correctAnswer;
  document.getElementById('modal').dataset.index = index;

  document.getElementById('answer').value = '';

  document.getElementById('overlay').style.display = 'block';
  document.getElementById('modal').style.display = 'block';
}

// Deze functie sluit de modal
function closeModal() {
  document.getElementById('overlay').style.display = 'none';
  document.getElementById('modal').style.display = 'none';
  document.getElementById('feedback').innerText = '';
}

// Deze functie controleert het antwoord
function checkAnswer() {
  let userAnswer = document.getElementById('answer').value.trim();
  let correctAnswer = document.getElementById('modal').dataset.answer;
  let feedback = document.getElementById('feedback');

  // Vraag is beantwoord → teller omhoog
  vragen++;

  // Check of goed
  if (userAnswer.toLowerCase() === correctAnswer.toLowerCase()) {
    score++;
    feedback.innerText = "Correct!";
    feedback.style.color = "green";
  } else {
    feedback.innerText = "Fout!";
    feedback.style.color = "red";
  }

  // Na 1 seconde sluiten
  setTimeout(() => {
    closeModal();

    // ALS ALLE 3 VRAGEN BEANTWOORD ZIJN → WIN OF VERLIES
    if (vragen === 3) {
      if (score === 3) {
        window.location.href = "../Winscherm.php";
      } else {
        window.location.href = "../Verliesscherm.php";
      }
    }

  }, 800);
}
