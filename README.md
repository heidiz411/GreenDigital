
# Green Digital MVC (PHP PDO + Bootstrap 3 + jQuery 3 + DataTables + Chart.js)

โครงสร้าง MVC แบบบางเบา + Router `?r=/path` พร้อม Auth (Login/Logout, RBAC, CSRF), CRUD ผ่าน Modal, DataTables + Export, Chart.js + Filters ตามสคีมา `greendigital.sql`.

## โครงสร้าง
ดูไดเรกทอรีภายในโฟลเดอร์นี้ (`app/`, `public/`, `sql/`). รูทเริ่มต้นอยู่ที่ `public/`.

## ติดตั้ง
1. Import `greendigital.sql` ของคุณ แล้วรัน `sql/patch.sql` (ครั้งเดียว) เพื่อแก้คอลัมน์/เพิ่มตารางที่จำเป็น
2. ตั้งค่า DB ใน `app/core/Config.php`
3. สร้างโฟลเดอร์อัปโหลด `public/uploads/` และให้สิทธิ์เขียน (`chmod 775`)
4. รันเว็บเซิร์ฟเวอร์: `php -S 127.0.0.1:8000 -t public`
5. เปิด `http://127.0.0.1:8000/?r=/login` → สมัครสมาชิก → ปรับ role ของบัญชีแรกเป็น `แอดมิน` ในฐานข้อมูล

## คุณสมบัติหลัก
- Login/Logout (password_hash/verify), Session guard, RBAC, CSRF
- สมาชิก: สมัคร, โปรไฟล์, เปลี่ยนรหัส, ลืมรหัสผ่าน (Q&A)
- ผู้ดูแล: สมาชิก, เนื้อหา (พร้อมอัปโหลดภาพ, schedule), ประเภทขยะ, บันทึกขยะ
- Dashboard: สรุป + กราฟ (ตามประเภท/เดือน)
- รายงาน: DataTables (ค้นหา/กรอง/ส่งออก CSV), Export server-side พร้อม filters

## หมายเหตุ
- ใช้ CDN ของ Bootstrap 3.4.1 / jQuery 3.7.1 / DataTables 1.13.x / Buttons 2.4.x / Chart.js
- หากข้อมูลใหญ่ แนะนำปรับ DataTables เป็น server-side

## ใบอนุญาต
ใช้เพื่อการศึกษา/สาธิต ปรับใช้ต่อได้ตามต้องการ
