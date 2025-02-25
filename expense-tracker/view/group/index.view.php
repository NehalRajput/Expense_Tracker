<?php require base_path('view/partials/head.php'); ?>
<?php require base_path('view/partials/banner.php'); ?>

<!-- Group Form -->
<div class="flex justify-center mt-10">
    <div class="bg-gray-900 p-6 rounded-xl shadow-lg w-11/12 max-w-md">
        <h2 class="text-xl font-semibold mb-4 text-white">Add Group</h2>
        
        <!-- Success message alert -->
        <div id="successMessage" class="hidden bg-green-500 text-white p-3 rounded-lg mb-4">
            Group created successfully!
        </div>

        <form action="/group/create" method="POST" id="groupForm">
            <input type="text" id="id" name="id" value="group" hidden />
            <input
                type="text"
                id="groupName"
                name="group_name"
                class="w-full p-3 border border-gray-700 rounded-lg focus:ring-2 focus:ring-gray-500 mb-4 bg-gray-800 text-white"
                placeholder="Enter Group Name"
                required
            />
            <span class="text-red-500"><?=$errors['name'] ?? '' ?></span>
            <div class="flex justify-end gap-2">
                <a href='/'
                    class="bg-gray-700 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">
                    Cancel
                </a>
                <button
                    type="submit"
                    class="bg-black text-white px-4 py-2 rounded-lg hover:bg-gray-800 transition">
                    Add Group
                </button>
            </div>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.19.3/jquery.validate.min.js"></script>
<script>
    $(document).ready(function () {
        $("#groupForm").validate({
            rules: {
                group_name: {
                    required: true,
                    minlength: 3
                }
            },
            messages: {
                group_name: {
                    required: "Please enter a group name",
                    minlength: "Group name must be at least 3 characters long"
                }
            },
            errorClass: "text-red-500",
            errorElement: "span"
        });

        // AJAX form submission
        $('#groupForm').on('submit', function (e) {
            e.preventDefault(); // Prevent form from submitting normally

            if ($(this).valid()) { // Check if form is valid
                $.ajax({
                    url: '/group/create',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function (response) {
                        $('#successMessage').removeClass('hidden').fadeIn(); // Show success message
                        $('#groupForm')[0].reset(); // Reset form fields
                        setTimeout(() => {
                            $('#successMessage').fadeOut(); // Hide message after 3 seconds
                        }, 3000);
                    },
                    error: function () {
                        alert('An error occurred while creating the group.');
                    }
                });
            }
        });
    });
</script>

<?php require base_path('view/partials/footer.php'); ?>


