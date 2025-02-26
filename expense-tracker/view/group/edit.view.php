<?php require base_path('view/partials/head.php'); ?>
<?php require base_path('view/partials/banner.php'); ?>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.21.0/dist/jquery.validate.min.js"></script>

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

        $('#groupForm').on('submit', function (e) {
            e.preventDefault();

            if ($(this).valid()) {
                $.ajax({
                    url: '/groups',
                    type: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function (response) {
                      //  console.log(response);
                        if (response.success) {
                            $('#message').html(`<p class="text-green-500">${response.message} ✅</p>`);
                            setTimeout(function() {
                                window.location.href = '/';
                            }, 1000);
                        } else {
                            $('#message').html(`<p class="text-red-500">${response.message} ❌</p>`);
                        }
                    },
                    error: function () {
                        $('#message').html('<p class="text-red-500">An error occurred while updating the group.</p>');
                    }
                });
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
                name="group_name"
                class="w-full p-3 border border-gray-500 rounded-lg focus:ring-2 focus:ring-gray-400 mb-4 bg-gray-800 text-white"
                placeholder="Enter Group Name"
                value="<?= htmlspecialchars($group['group_name']) ?>"
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
        <div id="message"></div>
    </div>
</div>

<?php require base_path('view/partials/footer.php'); ?>
