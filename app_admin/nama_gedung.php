<script src='https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.10/index.global.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.10/index.global.min.js'></script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Calendar</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Calendar</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">
          <div class="sticky-top mb-3">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Draggable Events</h4>
              </div>
              <div class="card-body">
                <!-- the events -->
                <div id="external-events">
                  <div class="external-event bg-success">Lunch</div>
                  <div class="external-event bg-warning">Go home</div>
                  <div class="external-event bg-info">Do homework</div>
                  <div class="external-event bg-primary">Work on UI design</div>
                  <div class="external-event bg-danger">Sleep tight</div>
                  <div class="checkbox">
                    <label for="drop-remove">
                      <input type="checkbox" id="drop-remove">
                      remove after drop
                    </label>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Create Event</h3>
              </div>
              <div class="card-body">
                <form id="event-form" action="./action_event/save_event.php" method="post" style="margin-top: 10px;">
                  <div class="form-group">
                    <label for="event-title">Title:</label>
                    <input type="text" class="form-control" id="event-title" name="event-title">
                  </div>
                  <div class="form-group">
                    <label for="event-description">Description:</label>
                    <textarea class="form-control" id="event-description" name="event-description" rows="3"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="start-date">Start Date:</label>
                    <input type="datetime-local" class="form-control" id="start-date" name="start-date">
                  </div>
                  <div class="form-group">
                    <label for="end-date">End Date:</label>
                    <input type="datetime-local" class="form-control" id="end-date" name="end-date">
                  </div>
                  <button type="submit" class="btn btn-primary">Save</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-9">
          <div class="card card-primary">
            <div class="card-body p-0">
              <!-- THE CALENDAR -->
              <div id="calendar"></div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>
  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth'
    });
    calendar.render();

    // Function to check if user is admin (dummy function, replace with your logic)
    function isAdmin() {
      // Example: check if user role is "admin"
      return true; // Change this based on your authentication logic
    }

    // Event listener for form submission
    document.getElementById('event-form').addEventListener('submit', function(event) {
      event.preventDefault(); // Prevent default form submission
      if (isAdmin()) {
        // Logic to save event data to database
        var formData = new FormData(this);
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
          console.log(this.readyState); // Log ready state
          console.log(this.status); // Log HTTP status
          if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            console.log(this.responseText); // Log response from server
            // Reset form fields after successful submission
            document.getElementById('event-title').value = '';
            document.getElementById('event-description').value = '';
            document.getElementById('start-date').value = '';
            document.getElementById('end-date').value = '';
          }
        };

        xhr.open("POST", this.action, true);
        xhr.send(formData);
      } else {
        alert("Only admins can save events to database.");
      }
    });

  });
</script>