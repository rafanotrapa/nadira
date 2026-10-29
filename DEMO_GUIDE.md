# BRITAKAN Platform — Step-by-Step Demo Guide

## Overview
BRITAKAN adalah platform advocacy pemuda untuk pelaporan bullying, sexual harassment, dan sexual assault. Demo ini menunjukkan seluruh flow dari user experience hingga admin dashboard.

---

## STEP 1: Explore Homepage

**URL:** `https://nadira-rgta.vercel.app/`

### Screenshot 1a: Hero Section
- Lihat headline: **"NO VOICE LEFT UNHEARD"**
- Subheadline menjelaskan misi BRITAKAN
- CTA buttons: "Get Help & Support" dan "Know Your Rights"
- Hero image menampilkan tema advocacy

**Action:** Scroll down untuk melihat konten selanjutnya.

---

## STEP 2: Explore Educational Content

### Screenshot 2a: Why BRITAKAN Exists
- Penjelasan singkat tentang tujuan platform
- Mission & Vision cards di sebelah kanan

### Screenshot 2b: Three Focus Areas
- Card 1: Bullying & Cyberbullying
- Card 2: Sexual Harassment
- Card 3: Sexual Assault & Abuse
- Setiap card memiliki tombol "Understand" / "Know Your Boundaries"

### Screenshot 2c: How BRITAKAN Works
- 4-step process: Learn → Seek Support → Take Action → Follow Up

### Screenshot 2d: Learn & Understand (Articles)
- 3 artikel edukasi dengan bilingual support (ID/EN)
- Featured article di atas dengan excerpt panjang
- 2 artikel tambahan di bawah
- Tombol bahasa di header (ID/EN toggle)

**Action:** Klik salah satu artikel untuk membaca full content di modal.

---

## STEP 3: Get Help & Support Section

### Screenshot 3: Support Cards
- Card 1: Immediate Danger (red badge, tombol Emergency Call 112)
- Card 2: School-Based Support
- Card 3: Professional Support
- Card 4: Formal Reporting

---

## STEP 4: Submit Report (Homepage)

### Screenshot 4a: Report Form
**Location:** Scroll ke section "Report an Incident"

**Form Fields:**
1. Incident Category (dropdown)
   - Bullying
   - Cyberbullying
   - Sexual Harassment
   - Sexual Assault or Abuse
   - Other Safety Concern

2. Your Role (dropdown)
   - I experienced the incident
   - I witnessed the incident
   - I am seeking help for someone else
   - I am unsure and need guidance

3. Incident Details (textarea)
   - Text input untuk deskripsi kejadian

### Screenshot 4b: Submit & Get Reference ID
**Action:**
1. Isi semua field (contoh: Category = "Bullying", Role = "I experienced", Description = "Saya dirangedem teman sekelas")
2. Klik tombol "Submit Report"
3. Form hilang, muncul Success Message dengan **Reference ID** (format: `BRITAKAN-XXXXXX`)
4. Terdapat tombol "Submit Another Report"

**Key Point:** Reference ID ini disimpan di browser localStorage dan akan digunakan untuk tracking.

---

## STEP 5: Track Ticket (Homepage)

### Screenshot 5a: Track Ticket Section
**Location:** Scroll ke section "Track Your Ticket"

**Form:**
- Input field untuk Reference ID
- Tombol "Check Status"

### Screenshot 5b: Tracking Result
**Action:**
1. Masukkan Reference ID dari Step 4 (contoh: `BRITAKAN-A1B2C3`)
2. Klik "Check Status"
3. Muncul hasil tracking:
   - Ticket Found
   - Category: [kategori yang dilaporkan]
   - Status: Received / Initial Review / Resolved
   - Submitted on: [tanggal & waktu]

**Key Point:** Status ini bisa berubah setelah admin mengupdate di dashboard.

---

## STEP 6: Admin Dashboard Access

### Screenshot 6a: Login Page
**URL:** `https://nadira-rgta.vercel.app/admin`

**Login Credentials:**
- Username: `admin`
- Password: `britakan2026`

**Action:**
1. Masukkan username & password
2. Klik "Login Dashboard"
3. Redirect ke admin dashboard

---

## STEP 7: Admin Dashboard Overview

### Screenshot 7a: Dashboard Header
- Judul: "Dashboard Laporan Insiden"
- Subtitle: "Kelola dan tinjau laporan insiden BRITAKAN"
- Tombol "Print" di kanan atas

### Screenshot 7b: Statistics Cards
Menampilkan 4 metric:
1. Total Reports (angka total)
2. Received (count biru)
3. In Review (count oranye)
4. Resolved (count hijau)

**Note:** Dengan 8 dummy reports:
- Total: 8
- Received: 3
- In Review: 2
- Resolved: 3

### Screenshot 7c: Reports Table
**Columns:**
- Ref ID (format `BRITAKAN-DEMO-XXX`)
- Kategori (Bullying, Cyberbullying, Sexual Harassment, etc.)
- Role (I experienced, Witness, Seeking help, etc.)
- Deskripsi (truncated dengan ellipsis)
- Status (badge: Received=blue, In Review=orange, Resolved=green)
- Tanggal (format: 2026-10-28 09:15:00)
- Aktivitas (dropdown untuk update status)

---

## STEP 8: Update Report Status

### Screenshot 8a: Change Status
**Action:**
1. Scroll ke table
2. Cari salah satu report (contoh: `BRITAKAN-DEMO-001`)
3. Di kolom "Aktivitas", klik dropdown (Status Selector)
4. Pilih status baru (contoh: dari "Received" ke "In Review")
5. Dropdown menutup otomatis, status terupdate
6. Stats cards di atas otomatis terupdate (In Review count bertambah)

### Screenshot 8b: Verify Update
**Action:**
1. Scroll ke section "Track Your Ticket"
2. Masukkan Reference ID laporan yang baru saja di-update
3. Klik "Check Status"
4. Verifikasi bahwa status sekarang menunjukkan "In Review" (status terbaru)

---

## STEP 9: Bilingual Support

### Screenshot 9: Language Toggle
**Location:** Navigation bar (header)

**Action:**
1. Klik tombol "EN" (English)
2. Seluruh halaman berubah ke bahasa Inggris
3. Artikel titles, descriptions, buttons semuanya dalam bahasa Inggris
4. Klik "ID" untuk kembali ke bahasa Indonesia

---

## STEP 10: Responsive Design

### Screenshot 10: Mobile View
**Action:**
1. Buka browser DevTools (F12)
2. Klik device toolbar (toggle mobile view)
3. Resize ke mobile (iPhone 12: 390px width)
4. Verifikasi:
   - Navigation hamburger menu muncul
   - Layout mobile-friendly
   - Form tetap responsif
   - Table di admin dashboard scroll horizontal jika perlu

---

## Summary of Key Features Demonstrated

✅ **Homepage:**
- Bilingual support (ID/EN)
- Educational content dengan articles modal
- Report form submission dengan localStorage
- Track ticket functionality

✅ **Admin Dashboard:**
- Secure login
- 8 dummy reports dengan berbagai status
- Statistics dashboard
- Status update dengan dropdown
- Professional UI dengan badges & custom styling

✅ **Data Persistence:**
- Laporan tersimpan di browser localStorage
- Data persist across page refresh
- Tracking berfungsi realtime

✅ **Responsive Design:**
- Mobile-first approach
- Desktop-optimized admin dashboard
- Custom dropdown styling di semua dropdown

---

## Testing Checklist

- [ ] Homepage loads dan hero section visible
- [ ] Language toggle (ID/EN) bekerja
- [ ] Read article modal membuka dengan isi
- [ ] Submit report form dan dapat Reference ID
- [ ] Track ticket dengan Reference ID menampilkan status
- [ ] Admin login dengan credentials yang benar
- [ ] Admin dashboard menampilkan 8 dummy reports
- [ ] Update status report dari dropdown
- [ ] Stats cards terupdate setelah status change
- [ ] Track ticket menampilkan status terbaru
- [ ] Mobile responsive menu bekerja
- [ ] Logout dari admin dashboard berfungsi

---

## Notes for Presentation

1. **Data Persistence:** Semua laporan disimpan di browser localStorage, jadi data akan persist sampai user clear browser cache.
2. **Dummy Data:** Admin dashboard seeded dengan 8 realistic dummy reports dengan berbagai kategori dan status.
3. **No Database Required:** Demo ini menggunakan client-side storage untuk kesederhanaan dan instant availability.
4. **Production Ready:** Untuk production, gunakan database eksternal (Supabase, PostgreSQL, MongoDB).

---

## Live URLs

- **Homepage:** `https://nadira-rgta.vercel.app/`
- **Admin Dashboard:** `https://nadira-rgta.vercel.app/admin`
- **GitHub Repo:** `https://github.com/rafanotrapa/nadira`

