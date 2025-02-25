<?php require base_path('view/partials/head.php'); ?>
<?php require base_path('view/partials/banner.php'); ?>

<!-- jQuery and Validation -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.19.3/jquery.validate.min.js"></script>
<script>
    $(document).ready(function () {
        $("#groupForm").validate({
            rules: {
                groupName: {
                    required: true,
                    minlength: 3
                }
            },
            messages: {
                groupName: {
                    required: "Please enter a group name",
                    minlength: "Group name must be at least 3 characters long"
                }
            },
            errorClass: "text-red-500",
            errorPlacement: function (error, element) {
                error.insertAfter(element);
            }
        });
    });
</script>

<!-- Group Form -->
<div class="flex justify-center mt-10">
    <div class="bg-black p-6 rounded-xl shadow-lg w-11/12 max-w-md">
        <h2 class="text-xl font-semibold mb-4 text-white">Edit Group</h2>
        <form action="/groups" method="POST" id="groupForm">
            <input type="hidden" name="_method" value="PATCH">
            <input type="hidden" name="id" value="<?= $group['id'] ?>"> 
            
            <input
                type="text"
                id="groupName"
                name="groupName"
                class="w-full p-3 border border-gray-500 rounded-lg focus:ring-2 focus:ring-gray-400 mb-4 bg-gray-800 text-white"
                placeholder="Enter Group Name"
                value="<?= $group['group_name'] ?>"
                required
            />
            
            <div class="flex justify-end gap-2">
                <a href='/'
                    class="bg-gray-700 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">
                    Cancel
                </a>
                <button
                    type="submit"
                    class="bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition">
                    Update Group
                </button>
            </div>
        </form>
    </div>
</div>

<?php require base_path('view/partials/footer.php'); ?>
