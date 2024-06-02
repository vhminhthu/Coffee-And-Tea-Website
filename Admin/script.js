const header = document.querySelector(".calendar h3");
const dates = document.querySelector(".dates");
const prevButton = document.getElementById("prev");
const nextButton = document.getElementById("next");

const months = [
  "January", "February", "March", "April", "May", "June",
  "July", "August", "September", "October", "November", "December"
];

let currentDate = new Date();
let month = currentDate.getMonth();
let year = currentDate.getFullYear();

function renderCalendar() {
  const start = new Date(year, month, 1).getDay();
  const endDate = new Date(year, month + 1, 0).getDate();
  const end = new Date(year, month, endDate).getDay();
  const endDatePrev = new Date(year, month, 0).getDate();

  let datesHtml = "";

  for (let i = start; i > 0; i--) {
    datesHtml += `<li class="inactive">${endDatePrev - i + 1}</li>`;
  }

  for (let i = 1; i <= endDate; i++) {
    let className = (i === currentDate.getDate() && month === currentDate.getMonth() && year === currentDate.getFullYear()) ? ' class="today"' : "";
    datesHtml += `<li${className}>${i}</li>`;
  }

  for (let i = end; i < 6; i++) {
    datesHtml += `<li class="inactive">${i - end + 1}</li>`;
  }

  dates.innerHTML = datesHtml;
  header.textContent = `${months[month]} ${year}`;
}

prevButton.addEventListener("click", () => {
  if (month === 0) {
    year--;
    month = 11;
  } else {
    month--;
  }
  renderCalendar();
});

nextButton.addEventListener("click", () => {
  if (month === 11) {
    year++;
    month = 0;
  } else {
    month++;
  }
  renderCalendar();
});

renderCalendar();
