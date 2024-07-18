<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shopping List</title>
  <!-- Đường dẫn tới thư viện Vue.js 2 -->
  <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
  <style>
    /* CSS cho đẹp mắt */
    table {
      border-collapse: collapse;
      width: 100%;
    }
    th, td {
      border: 1px solid black;
      padding: 8px;
      text-align: left;
    }
    th {
      background-color: #f2f2f2;
    }
    button {
      cursor: pointer;
    }
  </style>
</head>
<body>

<div id="app">
  <h1>Shopping List</h1>

  <!-- Form để thêm mục mới vào danh sách -->
  <form @submit.prevent="addItem">
    <label for="itemName">Item name:</label>
    <input type="text" id="itemName" v-model="newItem.name" required>
    <label for="itemQuantity">Quantity:</label>
    <input type="number" id="itemQuantity" v-model.number="newItem.quantity" required>
    <button type="submit">Add Item</button>
  </form>
<br>
  <!-- Bảng hiển thị danh sách mua sắm -->
  <table>
    <thead>
      <tr>
        <th>Name</th>
        <th>Quantity</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(item, index) in shoppingList" :key="index">
        <td>{{ item.name }}</td>
        <td>{{ item.quantity }}</td>
        <td>
          <button @click="viewItem(index)">View</button>
          <button @click="editItem(index)">Edit</button>
          <button @click="deleteItem(index)">Delete</button>
        </td>
      </tr>
    </tbody>
  </table>
</div>

<script>
  // Tạo ứng dụng Vue.js
  new Vue({
    el: '#app',
    data: {
      // Danh sách mua sắm ban đầu
      shoppingList: [
        { name: 'Apples', quantity: 5 },
        { name: 'Bananas', quantity: 3 },
        { name: 'Milk', quantity: 2 }
      ],
      // Mục mới sẽ được thêm vào danh sách
      newItem: {
        name: '',
        quantity: ''
      }
    },
    methods: {
      // Thêm một mục mới vào danh sách
      addItem() {
        if (this.newItem.name && this.newItem.quantity) {
          this.shoppingList.push({
            name: this.newItem.name,
            quantity: this.newItem.quantity
          });
          this.newItem.name = '';
          this.newItem.quantity = '';
        }
      },
      // Xem thông tin của một mục
      viewItem(index) {
        alert(`Item: ${this.shoppingList[index].name}\nQuantity: ${this.shoppingList[index].quantity}`);
      },
      // Sửa thông tin của một mục
      editItem(index) {
        const newName = prompt('Enter new name:', this.shoppingList[index].name);
        const newQuantity = prompt('Enter new quantity:', this.shoppingList[index].quantity);
        if (newName !== null && newQuantity !== null) {
          this.shoppingList[index].name = newName;
          this.shoppingList[index].quantity = newQuantity;
        }
      },
      // Xóa một mục khỏi danh sách
      deleteItem(index) {
        if (confirm('Are you sure you want to delete this item?')) {
          this.shoppingList.splice(index, 1);
        }
      }
    }
  });
</script>

</body>
</html>
