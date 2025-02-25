<?php require base_path('view/partials/head.php'); ?>
<?php require base_path('view/partials/banner.php'); ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.19.3/jquery.validate.min.js"></script>
<script>
    $(document).ready(function () {
        // jQuery Validation
        $("#expenseForm").validate({
            rules: {
                expense_name: {
                    required: true,
                    minlength: 3
                },
                amount: {
                    required: true,
                    number: true,
                    min: 1
                },
                expense_date: {
                    required: true,
                    date: true
                },
                group_id: {
                    required: true
                }
            },
            messages: {
                expense_name: {
                    required: "Please enter an expense name",
                    minlength: "Expense name must be at least 3 characters"
                },
                amount: {
                    required: "Please enter an amount",
                    number: "Amount must be a number",
                    min: "Amount must be at least 1"
                },
                expense_date: {
                    required: "Please select a date",
                    date: "Please enter a valid date"
                },
                group_id: {
                    required: "Please select a group"
                }
            }
        });
    });
</script>

<!-- Expense Form -->
<div class="flex justify-center mt-10">
    <div class="bg-white p-6 rounded-xl shadow-lg w-11/12 max-w-md">
        <h2 class="text-xl font-semibold mb-4 text-black">Edit Expense</h2>
        <form id="expenseForm" action="/expenses" method="POST">
            <input type="hidden" name="_method" value="PATCH">
            <input type="hidden" name="id" value="<?= $expense['id'] ?>">
            
            <input 
                type="text" 
                id="expense_name" 
                name="expense_name" 
                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black mb-4"
                placeholder="Expense Name" 
                required 
                value="<?= htmlspecialchars($expense['expense_name'] ?? '') ?>"
            />

            <input
                type="number"
                id="amount"
                name="amount"
                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black mb-4"
                placeholder="Amount"
                required
                value="<?= floor($expense['amount']) ?>"
            />
            
            <select
                id="group_id"
                name="group_id"
                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black mb-4"
                required
            >
                <?php foreach ($groups as $group): ?>
                    <option value="<?= $group['id'] ?>" 
                        <?= (isset($expense['group_id']) && $expense['group_id'] == $group['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($group['group_name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <input
                type="date"
                id="expense_date"
                name="expense_date"
                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black mb-4"
                required
                value="<?= $expense['expense_date'] ?>"
            />

            <div class="flex justify-end gap-2">
                <a href='/'
                    class="bg-gray-200 text-black px-4 py-2 rounded-lg hover:bg-gray-300 transition">
                    Cancel
                </a>
                <button type="submit"
                    class="bg-black text-white px-4 py-2 rounded-lg hover:bg-gray-800 transition">
                    Update Expense
                </button>
            </div>
        </form>
    </div>
</div>

<?php require base_path('view/partials/footer.php'); ?>
