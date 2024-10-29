
<div class="modal fade" id="assignTaskModal" tabindex="-1" role="dialog" aria-labelledby="assignTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="assignTaskModalLabel">Assign Task to <span id="workerName"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Add your task assignment form here -->
                <form action="{{ route('tasks.assignTask', ':userId') }}" method="post">
                    @csrf
                    <!-- Include task details in the form as needed -->
                    <label for="task_title">Task Title:</label>
                    <select name="task_title" id="task_title">
                        <option value="IAR">IAR</option>
                        <option value="Stock">Stock</option>
                        <option value="Property">Property</option>
                        <option value="RLSDDSP">RLSDDSP</option>
                        <option value="WMR">WMR</option>
                        <option value="RIS">RIS</option>
                        <option value="RFCI">RFCI</option>
                        <option value="ICS">ICS</option>
                        <option value="RSMI">RSMI</option>
                        <option value="RAAF">RAAF</option>
                        <option value="SPC">SPC</option>
                        <option value="RSPI">RSPI</option>
                        <option value="RegSPI">RegSPI</option>
                        <option value="ITR">ITR</option>
                        <option value="IIRUP/SEMI">IIRUP/SEMI</option>
                        <option value="PAR">PAR</option>
                        <option value="RCPPE">RCPPE</option>
                        <option value="PTR">PTR</option>
                        <option value="IIRUP/PPE">IIRUP/PPE</option>
                        <option value="RLSDDP">RLSDDP</option>
                        <option value="RETURNED/PPE">RETURNED/PPE</option>
                    </select>
                    <label for="priority">Priority:</label>
                    <select name="priority" id="priority">
                        <option value="High">High Priority</option>
                        <option value="Medium">Medium Priority</option>
                        <option value="Low">Low Priority</option>
                    </select>
                    <label for="task_description">Task Description:</label>
                    <textarea name="task_description" required></textarea>

                    <button type="submit" class="btn btn-primary">Assign Task</button>
                </form>
            </div>  
        </div>
    </div>
</div>

<script>
    // Update modal content based on the clicked worker
    $('#assignTaskModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var userId = button.data('user-id');
        var workerName = button.closest('.card').find('.card-title').text();
        
        // Update the modal title and form action dynamically
        var modal = $(this);
        modal.find('.modal-title #workerName').text(workerName);
        modal.find('form').attr('action', '/tasks/' + userId + '/assign');
    });
</script>
