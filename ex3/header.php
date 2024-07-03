
<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    integrity="sha512-..." crossorigin="anonymous" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<style>
  body {
    margin: 0;
  }

  ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    width: 250px;
    background: url('../images/pic03.png') no-repeat center center fixed;
    /* background-color: #D9D9D9; */
    position: fixed;
    height: 100%;
    overflow: auto;
  }

  li a,
  .dropbtn {
    display: block;
    color: rgb(0, 0, 0);
    padding: 16px;
    text-decoration: none;
  }

  li a:hover,
  .dropdown:hover .dropbtn {
    background-color: #ead582;
    color: black;
  }

  li.dropdown {
    display: block;
  }

  .dropdown-icon {
    margin-right: 8px;
    /* ปรับระยะห่างระหว่างไอคอนและข้อความได้ตามต้องการ */
  }

  .dropdown-content {
    display: none;
  }

  .dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    text-align: left;
  }

  .dropdown-content a:hover {
    background-color: #fff4c8;
  }
</style>


<body>
  <ul>
    <li class="dropdown">
      <!-- <a href="#" class="dropbtn">ผู้ใช้งาน</a> -->
      <a href="#" class="dropbtn"><i class="fas fa-user-friends dropdown-icon"></i>แผนก</a>
      <div class="dropdown-content">
        <a href="show_section.php"><i class="fas fa-user dropdown-icon"></i>ข้อมูลแผนก</a>
        <a href="add_section.php"><i class="fas fa-user-shield dropdown-icon"></i>เพิ่มแผนก</a>
      </div>
    </li>
    <li class="dropdown">
      <!-- <a href="#" class="dropbtn">ผู้ใช้งาน</a> -->
      <a href="#" class="dropbtn"><i class="fas fa-user-friends dropdown-icon"></i>พนักงาน</a>
      <div class="dropdown-content">
        <a href="show_person.php"><i class="fas fa-user dropdown-icon"></i>ข้อมูลพนักงาน</a>
        <a href="add_person.php"><i class="fas fa-user-shield dropdown-icon"></i>เพิ่มข้อมูลพนักงาน</a>
      </div>
    </li>
    <li class="dropdown">
      <!-- <a href="#" class="dropbtn">ผู้ใช้งาน</a> -->
      <a href="#" class="dropbtn"><i class="fas fa-user-friends dropdown-icon"></i>ลูกค้า</a>
      <div class="dropdown-content">
        <a href="show_customer.php"><i class="fas fa-user dropdown-icon"></i>ข้อมูลลูกค้า</a>
        <a href="add_customer.php"><i class="fas fa-user-shield dropdown-icon"></i>เพิ่มข้อมูลลูกค้า</a>
      </div>
    </li>

  </ul>
  <script>
    document.querySelectorAll('.dropdown').forEach(function(dropdown) {
      dropdown.addEventListener('click', function() {
        // ปิดหัวข้อย่อยของหัวข้อหลักอื่นๆ
        document.querySelectorAll('.dropdown-content').forEach(function(content) {
          if (content !== this.querySelector('.dropdown-content')) {
            content.style.display = 'none';
          }
        }.bind(this));

        // แสดงหรือซ่อนหัวข้อย่อยของหัวข้อที่คลิก
        this.classList.toggle('open');
        var dropdownContent = this.querySelector('.dropdown-content');
        if (dropdownContent.style.display === 'flex') {
          dropdownContent.style.display = 'none';
        } else {
          dropdownContent.style.display = 'flex';
          dropdownContent.style.flexDirection = 'column';
          dropdownContent.style.paddingLeft = '20px';
        }
      });
    });
  </script>

</body>

</html>