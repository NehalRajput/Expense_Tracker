<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Group</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-gray-800 text-white">

<!-- Group Form -->
<div class="flex justify-center mt-10">
    <div class="bg-gray-900 p-6 rounded-xl shadow-lg w-11/12 max-w-md">
        <h2 class="text-xl font-semibold mb-4">Add Group</h2>
        
        <form id="groupForm" action="/group/create" method="POST">
            <input type="text" id="id" name="id" value="group" hidden />
            <input
                type="text"
                id="groupName"
                name="group_name"
                class="w-full p-3 border border-gray-700 rounded-lg focus:ring-2 focus:ring-gray-500 mb-4 bg-gray-800"
                placeholder="Enter Group Name"
                required
            />
            <span id="error" class="text-red-500"></span>
            
            <!-- Message Area -->
            <div id="message" class="mt-4"></div>
            
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
                    url: '/group/create',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function (response) {
                        if(response.success){
                            $('#message').html(`<p class="text-green-500">${response.message} ✅</p>`);
                            $('#groupForm')[0].reset();
                            setTimeout(function() {
                                window.location.href = '/';
                            }, 1000); // Redirect to homepage after 3 seconds
                        } else {
                            $('#message').html(`<p class="text-red-500">${response.message} ❌</p>`);
                        }
                    },
                    error: function () {
                        $('#message').html('<p class="text-red-500"> An error occurred while creating the group.</p>');
                    }
                });
            }
        });
    });
</script>

</body>
</html>
