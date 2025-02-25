<?php require base_path('view/partials/head.php'); ?>
<?php require base_path('view/partials/banner.php'); ?>


<!-- Group Form -->
<div class="flex justify-center mt-10">
    <div class="bg-gray-900 p-6 rounded-xl shadow-lg w-11/12 max-w-md">
        <h2 class="text-xl font-semibold mb-4 text-white">Add Group</h2>
        <form action="/groups" method="POST" id="groupForm">
            <input type="text" id="id" name="id" value="group" hidden />
            <input
                type="text"
                id="groupName"
                name="groupName"
                class="w-full p-3 border border-gray-700 rounded-lg focus:ring-2 focus:ring-gray-500 mb-4 bg-gray-800 text-white"
                placeholder="Enter Group Name"
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

<?php require base_path('view/partials/footer.php'); ?>
