<?php include ("./header.php"); ?>

  <main class="container p-4 my-4">
    <div class="row">
      <div class="col-md-5">

        <div class="card rounded-4">
          <div class="card-header text-center">
            <h4>Tasks</h4>
          </div>
          <div class="card-body">
            <form id="task-form">
              <input type="hidden" id="taskId">
              <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Task name..." required>
              </div>
              <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="description" placeholder="Task description..." rows="3" style="resize: none;" required></textarea>
              </div>
              <button type="submit" class="btn btn-primary form-control rounded-4">Submit</button>
            </form>
          </div>
        </div>
      </div>

      <div class="col-md-7">

        <div class="table-responsive-sm text-center">
          <table class="table table-bordered table-hover">
            <thead class="table-dark">
              <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Description</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody id="tasks"></tbody>
          </table>
        </div>

        <div class="card my-4 rounded-4" id="task-result">
          <div class="card-body">
            <ul id="container"></ul>
          </div>
        </div>

      </div>
    </div>
  </main>

<?php include ("./footer.php"); ?>