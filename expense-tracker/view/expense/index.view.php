<?php require base_path('view/partials/head.php'); ?>
<?php require base_path('view/partials/banner.php'); ?>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script>
    $(document).ready(function () {
        let today = new Date().toISOString().split('T')[0];
        $("#expense_date").val(today);

        $("#expenseForm").submit(function (e) {
            e.preventDefault();
            let formData = $(this).serialize();
            let isValid = true;

            $(".error").remove();
            $("#message").html('');

            const expenseName = $("#expense_name").val().trim();
            const amount = $("#amount").val().trim();
            const groupId = $("#group-Name").val();
            const expenseDate = $("#expense_date").val();

            if (!expenseName) {
                $("#expense_name").after('<span class="error text-red-500">Expense name is required</span>');
                isValid = false;
            }

            if (!amount || isNaN(amount) || parseFloat(amount) <= 0) {
                $("#amount").after('<span class="error text-red-500">Enter a valid amount</span>');
                isValid = false;
            }

            if (!groupId) {
                $("#group-Name").after('<span class="error text-red-500">Please select a group</span>');
                isValid = false;
            }

            if (!expenseDate) {
                $("#expense_date").after('<span class="error text-red-500">Expense date is required</span>');
                isValid = false;
            }

            if (!isValid) return;

            $.ajax({
                url: '/expense',
                type: 'POST',
                data: formData,
                success: function (response) {
                    if (response.success) {
                        $("#expenseForm")[0].reset();
                        $("#expense_date").val(today);
                        $("#message").html('<p class="text-green-500">' + response.message + ' ✅</p>');
                        
                        setTimeout(() => {
                            window.location.href = '/';
                        }, 1000);
                    } else {
                        $("#message").html('<p class="text-red-500">' + response.message + ' ❌</p>');
                    }
                },
                error: function () {
                    $("#message").html('<p class="text-red-500">An error occurred while adding the expense.</p>');
                }
            });
        });
    });
</script>

<!-- Expense Form -->
<div class="flex justify-center mt-10">
    <div class="bg-[#f7fafc] p-6 rounded-xl shadow-lg w-11/12 max-w-md">
        <h2 class="text-xl font-semibold mb-4 text-[#2b6cb0]">Add Expense</h2>
        <div id="message" class="mb-4"></div>
        <form id="expenseForm" action="/expense" method="POST">
            <input type="text" id="expense_name" name="expense_name" class="w-full p-3 border border-[#2b6cb0] rounded-lg mb-4" placeholder="Expense Name">
            <input type="number" id="amount" name="amount" class="w-full p-3 border border-[#2b6cb0] rounded-lg mb-4" placeholder="Amount">
            
            <?php if (count($groups) === 0): ?>
                <input type="text" id="group_id" class="w-full p-3 border border-red-500 rounded-lg mb-4" placeholder="No Group Found" disabled>
            <?php else: ?>
                <select id="group-Name" name="group_id" class="w-full p-3 border border-[#2b6cb0] rounded-lg mb-4">
                    <option value="">Select Group</option>
                    <?php foreach ($groups as $group): ?>
                        <option value="<?= $group['id'] ?>">
                            <?= htmlspecialchars($group['group_name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            <?php endif; ?>

            <input type="date" id="expense_date" name="expense_date" class="w-full p-3 border border-[#2b6cb0] rounded-lg mb-4">

            <div class="flex justify-end gap-2">
                <a href='/' class="bg-gray-200 text-[#2b6cb0] px-4 py-2 rounded-lg hover:bg-gray-300 transition">Cancel</a>
                <button type="submit" class="bg-[#2b6cb0] text-white px-4 py-2 rounded-lg hover:bg-[#2c5282] transition">Add Expense</button>
            </div>
        </form>
    </div>
</div>

<?php require base_path('view/partials/footer.php'); ?>
