let appointmentDates = []; // Change from const to let
const daysTag = document.querySelector(".days"),
  currentDate = document.querySelector(".current-date"),
  prevNextIcon = document.querySelectorAll(".icons span");

// getting new date, current year and month
let date = new Date(),
  currYear = date.getFullYear(),
  currMonth = date.getMonth();

fetch('files/query.php')
  .then(response => response.json())
  .then(data => {
    console.log('Fetched data:', data);

    // Use the retrieved appointment dates in your calendar
    appointmentDates = data;

    // Call the renderCalendar function to update the calendar
    renderCalendar();
  })
  .catch(error => console.error('Error fetching data:', error));
// storing full name of all months in array
const months = ["January", "February", "March", "April", "May", "June", "July",
              "August", "September", "October", "November", "December"];

  const renderCalendar = () => {
    let firstDayofMonth = new Date(currYear, currMonth, 1).getDay(),
      lastDateofMonth = new Date(currYear, currMonth + 1, 0).getDate(),
      lastDayofMonth = new Date(currYear, currMonth, lastDateofMonth).getDay(),
      lastDateofLastMonth = new Date(currYear, currMonth, 0).getDate();
    let liTag = "";

    for (let i = firstDayofMonth; i > 0; i--) {
      liTag += `<li class="inactive">${lastDateofLastMonth - i + 1}</li>`;
    }
   
  for (let i = 1; i <= lastDateofMonth; i++) {
    let currentDate = new Date(currYear, currMonth, i);

    // Format the date in Asia/Manila time zone
    let formattedToday = new Date().toLocaleDateString('en-US', { timeZone: 'Asia/Manila' });
    let formattedCurrentDate = currentDate.toLocaleDateString('en-US', { timeZone: 'Asia/Manila' });

    // Compare formatted dates
    let isToday = formattedCurrentDate === formattedToday;

    // Format the appointment dates in Asia/Manila time zone
    let formattedAppointmentDates = appointmentDates.map(
      appointmentDate => new Date(appointmentDate).toLocaleDateString('en-US', { timeZone: 'Asia/Manila' })
    );

    // Check if the current date has an appointment
    let hasAppointment = formattedAppointmentDates.includes(formattedCurrentDate);

    // Apply red background if there is an appointment
    let appointmentClass = hasAppointment ? "has-appointment" : "";

    // Add a note if the date is fully booked
    let noteText = hasAppointment ? "Fully Booked" : "";

    // Add an event listener for the "click" event to show/hide the note
    liTag += `<li class="${isToday ? "active" : ""} ${appointmentClass}" onclick="showNote('${noteText}')">${i}<span class="note">${noteText}</span></li>`;
  }

    for (let i = lastDayofMonth; i < 6; i++) {
      liTag += `<li class="inactive">${i - lastDayofMonth + 1}</li>`;
    }
    currentDate.innerText = `${months[currMonth]} ${currYear}`;
    daysTag.innerHTML = liTag;
  };

  renderCalendar();

prevNextIcon.forEach(icon => { // getting prev and next icons
    icon.addEventListener("click", () => { // adding click event on both icons
        // if clicked icon is previous icon then decrement current month by 1 else increment it by 1
        currMonth = icon.id === "prev" ? currMonth - 1 : currMonth + 1;

        if(currMonth < 0 || currMonth > 11) { // if current month is less than 0 or greater than 11
            // creating a new date of current year & month and pass it as date value
            date = new Date(currYear, currMonth, new Date().getDate());
            currYear = date.getFullYear(); // updating current year with new date year
            currMonth = date.getMonth(); // updating current month with new date month
        } else {
            date = new Date(); // pass the current date as date value
        }
        renderCalendar(); // calling renderCalendar function
    });
});