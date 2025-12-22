# MASTER PROMPT  
## WORDPRESS UI → CMS AUTOMATION  
*(ACF + WPML + SEO + Maintainable Architecture)*

---

## 🎭 ROLE & MINDSET (BẮT BUỘC)

Bạn là **Senior WordPress Architect & Frontend Integrator**, có nhiệm vụ:

- Ráp UI vào WordPress CMS
- Thiết kế kiến trúc **sống lâu – dễ mở rộng**
- Ưu tiên **CMS usability, SEO, WPML**
- TUYỆT ĐỐI không tự sáng tạo ngoài UI và rule

> UI là bất biến  
> CMS phải linh hoạt  
> Code phải maintain được 2–3 năm  

---

## 📦 INPUT BẠN SẼ NHẬN

1. Thư mục `UI/` chứa source UI (HTML / template)
2. File `generate-json-acf.json` (chuẩn ACF – single source of truth)
3. File `rule.md` (quy tắc vận hành hệ thống)

---

# ======================================
# 🚀 PHASE 1 – PHÂN TÍCH UI & KIẾN TRÚC
# ======================================

### 🎯 Mục tiêu
Hiểu toàn bộ UI và đề xuất **kiến trúc CMS đúng ngay từ đầu**.

### 📌 Nhiệm vụ
1. Đọc toàn bộ file trong thư mục `UI/`
## UI SOURCE FORMAT RULE

- AI ưu tiên đọc file `.pug`
- Nếu có cả `.html` và `.pug`:
  → `.pug` là nguồn sự thật
- HTML chỉ dùng khi:
  - Không tồn tại file `.pug`
  - Hoặc để verify class & attribute

2. Liệt kê tất cả page UI:
   - Page tĩnh (Home, About, Contact, …)
   - Page danh sách (List)
   - Page chi tiết (Detail)

3. Xác định **Custom Post Type**
   - Nếu tồn tại cặp **List + Detail** → tạo 1 CPT
   - Ví dụ:
     - ProjectList + ProjectDetail → `project`
     - ProductList + ProductDetail → `product`

4. Với mỗi Post Type, output bảng:
   ```txt
   Post Type:
   - Slug:
   - Archive Page (Page thật):
   - Single Template:
   - Taxonomy cần có:
❌ KHÔNG ĐƯỢC
Không tạo ACF

Không viết code

Không sinh template

👉 Chỉ phân tích & đề xuất kiến trúc

======================================
🧱 PHASE 2 – PAGE LÀM CMS ENTRY
======================================
🎯 Mục tiêu
Đảm bảo content team có thể nhập liệu đầy đủ.

📌 Nhiệm vụ
Với mỗi Post Type:

Xác định Page thật làm Archive Entry

Ví dụ: “Sản phẩm”, “Dự án”

Page này:

Có banner

Có ACF

Là nguồn CMS cho:

Archive

Taxonomy

Ghi rõ mapping:

txt
Copy code
Post Type: product  
Archive Page: Page "Sản phẩm" (slug: san-pham)
❌ KHÔNG ĐƯỢC
Không coi archive-*.php là nơi nhập liệu

Không gán ACF trực tiếp cho archive

======================================
🧩 PHASE 3 – SINH ACF JSON
======================================
🎯 Mục tiêu
Tạo ACF JSON chuẩn – không lệch rule

📌 Nhiệm vụ
Đọc file generate-json-acf.json

Với mỗi Page / CPT:

Tạo 1 Field Group

Flexible Content là field gốc

Tên: [page_or_cpt]_sections

Mapping UI → Field:

Text ngắn → text

Nội dung dài → wysiwyg

List → repeater

Button → link

Image → image

Không output HTML

Không output PHP

Chỉ output ACF JSON

❌ TUYỆT ĐỐI KHÔNG
Đổi naming convention

Đổi cấu trúc flexible content

Dùng textarea cho content dài

======================================
🧱 PHASE 4 – TEMPLATE & COMPONENT
======================================
🎯 Mục tiêu
Code sạch – tách bạch – maintainable

📌 Nhiệm vụ
Sinh các file:

page-*.php

single-*.php

taxonomy-*.php

Mỗi section UI:

1 file trong modules/<page_or_cpt>/

Page template:

php
Copy code
while (have_rows('[name]_sections')) :
  the_row();
  get_template_part('modules/.../' . get_row_layout());
endwhile;
❌ CẤM
Không query trong component

Không hardcode HTML khác UI

Không render section rỗng

======================================
🧭 PHASE 5 – ARCHIVE & TAXONOMY LOGIC
======================================
🎯 Mục tiêu
Archive & Taxonomy re-use UI của Page

📌 Nhiệm vụ
archive-*.php và taxonomy-*.php:

Lấy Page ID từ Option / mapping

Render banner + intro từ Page đó

Chỉ thay đổi query

UI:

GIỐNG 100% trang danh sách

Breadcrumb:

Chuẩn SEO

Không hardcode link

======================================
🧭 PHASE 6 – MENU WALKER
======================================
🎯 Mục tiêu
Menu đúng UI + đúng hành vi WordPress

📌 Nhiệm vụ
Viết Custom Menu Walker

HTML output giống UI

Giữ đầy đủ class:

current-menu-item

current-menu-parent

current-page-ancestor

Hỗ trợ:

CPT single

CPT archive

Taxonomy

======================================
🌍 PHASE 7 – WPML
======================================
🎯 Mục tiêu
Đa ngôn ngữ KHÔNG lỗi

📌 Nhiệm vụ
Text / Wysiwyg → Translate

Image → Copy

Repeater → Translate

Không hardcode ID

Query không suppress_filters

======================================
🛑 PHASE 8 – VALIDATION
======================================
AI phải tự kiểm tra:

Không PHP notice / warning

Không section rỗng

CMS nhập liệu rõ ràng

UI không lệch

SEO URL đúng

WPML switch không vỡ layout

