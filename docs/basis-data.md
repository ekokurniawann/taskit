# 📑 Dokumentasi Rancangan Basis Data - Task Management App

Dokumentasi ini berisi rancangan basis data *production-ready* yang mendukung fitur multi-role, multi-department, kolaborasi tim, dan audit trail.

---

## 🏗️ Skema Tabel

### 1. Tabel `roles`

Menyimpan level otoritas akses dalam sistem.

```sql
CREATE TABLE roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) UNIQUE NOT NULL,       -- Contoh: Manager, Supervisor, Leader, Programmer
    description TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

```

### 2. Tabel `departments`

Menyimpan daftar unit kerja atau departemen.

```sql
CREATE TABLE departments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) UNIQUE NOT NULL,      -- Contoh: Warehouse, Purchasing, Produksi
    description TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

```

### 3. Tabel `users`

Data kredensial untuk kebutuhan login dan penentuan role.

```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role_id INT NOT NULL,                    -- Foreign Key ke roles
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (role_id) REFERENCES roles(id)
);

```

### 4. Tabel `user_details`

Menyimpan profil lengkap dan status kepegawaian pengguna.

```sql
CREATE TABLE user_details (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,                     -- Foreign Key ke users
    name VARCHAR(100),
    phone VARCHAR(20),
    status ENUM('active','inactive','resigned') DEFAULT 'active',
    position VARCHAR(50),                     -- Contoh: Senior Dev, Jr. Programmer
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

```

### 5. Tabel `user_departments`

Relasi *Many-to-Many* antara User dan Departemen (Mendukung satu user di banyak departemen).

```sql
CREATE TABLE user_departments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    department_id INT NOT NULL,
    is_primary BOOLEAN DEFAULT FALSE,         -- Penanda departemen utama
    assigned_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (department_id) REFERENCES departments(id) ON DELETE CASCADE,
    UNIQUE(user_id, department_id)
);

```

### 6. Tabel `tasks`

Entitas utama untuk pengelolaan tugas dan status progres.

```sql
CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    creator_id INT NOT NULL,                  -- User yang membuat task (Manager/Leader)
    department_id INT NOT NULL,               -- Departemen pemilik task saat ini
    original_department_id INT,               -- Audit trail: Departemen asal jika di-transfer
    status ENUM('pending','in_progress','done') DEFAULT 'pending',
    priority ENUM('low','medium','high') DEFAULT 'medium',
    deadline DATETIME,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (creator_id) REFERENCES users(id),
    FOREIGN KEY (department_id) REFERENCES departments(id),
    FOREIGN KEY (original_department_id) REFERENCES departments(id)
);

```

### 7. Tabel `task_users`

Menampung kolaborator dalam satu tugas (Programmer Utama vs Anggota).

```sql
CREATE TABLE task_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    task_id INT NOT NULL,
    user_id INT NOT NULL,
    role ENUM('assignee','collaborator') DEFAULT 'collaborator',
    joined_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (task_id) REFERENCES tasks(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    UNIQUE(task_id, user_id)
);

```

### 8. Tabel `task_comments`

Media diskusi dan pelaporan progres di dalam setiap tugas.

```sql
CREATE TABLE task_comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    task_id INT NOT NULL,
    user_id INT NOT NULL,
    comment TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (task_id) REFERENCES tasks(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

```

---