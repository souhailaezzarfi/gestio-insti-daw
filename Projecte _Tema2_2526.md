# **Projecte: Gestor Institut Carles Vallbona**

## Context del projecte

Un institut que imparteix **CFGS d'informàtica** necessita una aplicació web per gestionar alumnes, professors, mòduls, grups i matrícules.

L’aplicació s’ha de desenvolupar amb **Laravel** seguint el patró **MVC** i utilitzant totes les funcionalitats treballades al **Tema 2**.

L’objectiu del projecte és aplicar de manera pràctica els conceptes de rutes, controladors, Blade, Eloquent, migracions, relacions, validacions, autenticació, cookies, transaccions i consultes avançades.

---

## Requisits generals

- Framework: **Laravel**
- Base de dades: **MySQL**
- Arquitectura MVC
- Ús de Blade per a les vistes
- Autenticació amb **Laravel Breeze**
- Bones pràctiques de nomenclatura i estructuració del codi

---

## Models i funcionalitats

### 1. Professors

**Taula:** `professors`

**Camps:**

- `id` (clau primària autoincrement)
- `nom`
- `cognoms`
- `email` (correu electrònic únic)
- `foto` (nullable, nom del fitxer de la imatge)
- `timestamps` (created\_at i updated\_at)

**Funcionalitats:**

- CRUD complet (llistar, crear, editar i eliminar)
- Pujada d’una imatge de perfil del professor
  - Guardar la imatge a `public/uploads/fotos`
  - Guardar el nom del fitxer a la base de dades
  - Variable d’entorn `.env`: `RUTA_FOTOS=uploads/fotos`
- Validacions:
  - `nom`: required
  - `cognoms`: required
  - `email` : required, email, unique

**Relacions:**

- Un professor pot impartir molts mòduls (`hasMany`)

---

### 2. Mòduls

**Taula:** `moduls`

**Camps:**

- `id` (clau primària autoincrement)
- `nom` (nom descriptiu)
- `hores` (nombre d’hores del mòdul)
- `professor_id` (nullable, professor que imparteix el mòdul)
- `timestamps` (created\_at i updated\_at)

**Funcionalitats:**

- CRUD complet
- Assignació opcional d’un professor
- Validacions:
  - `nom` : required
  - `hores`: required, integer, mínim 1

**Relacions:**

- Un mòdul pertany a un professor (`belongsTo`)

---

### 3. Alumnes

**Taula:** `alumnes`

**Camps:**

- `id` (clau primària autoincrement)
- `nom`
- `cognoms`
- `dni` (valor únic)
- `data_naixement`
- `telefon` (nullable)
- `grup_id` (nullable)
- `timestamps` (created\_at i updated\_at)

**Funcionalitats:**

- CRUD complet
- Validacions:
  - `nom`: required
  - `cognoms`: required
  - `dni`: required, unique
  - `data_naixement`: data anterior a avui

---

### 4. Grups

**Taula:** `grups`

**Camps:**

- `id` (clau primària autoincrement)
- `nom` (nom descriptiu) (ex. 2DAW)
- `aula` (aula assignada al grup)
- `professor_id` (tutor del grup, unique i required, )
- `timestamps` (created\_at i updated\_at, gestió automàtica de dates)

**Funcionalitats:**

- CRUD complet
- Assignació obligatòria d’un **professor responsable (tutor)** del grup

**Relacions:**

- Un grup té un professor responsable (`belongsTo`)
- Un professor pot ser responsable d'un únic grup

---

### 5. Matrícules (Many-to-Many)

**Taula pivot:** `alumne_modul`

**Camps:**

- `alumne_id` (referència a l’alumne)
- `modul_id` (referència al mòdul)
- `nota` (nullable, qualificació de l’alumne en el mòdul)

**Funcionalitats:**

- En crear o editar un alumne:

  - Seleccionar mòduls mitjançant checkbox
  - Introduir la nota de cada mòdul

- Guardar relacions:

  - `attach()` en crear
  - `sync()` en editar

- Mostrar als llistats:

  - Nom del mòdul
  - Nota (`pivot->nota`)

---

## Funcionalitats transversals

### Autenticació

- Instal·lar **Laravel Breeze**
- Navbar amb:
  - Login / Register (usuaris no autenticats)
  - Nom d’usuari i Logout (usuaris autenticats)
- Restriccions:
  - Usuaris no autenticats: només poden veure llistats
  - Usuaris autenticats: poden crear, editar i eliminar

---

### Cookies

- Guardar en una cookie el **darrer grup seleccionat** en crear un alumne
- Preseleccionar el grup al formulari si la cookie existeix
- Enllaç per esborrar la cookie visible només si existeix

---

### Filtres i consultes avançades

- Llistat d’alumnes amb:
  - Cerca per DNI o cognoms
  - Filtre per nota mínima amb operador AND / OR
- Llistat de professors amb ordenació:
  - Nom ascendent / descendent
  - Cognoms ascendent / descendent
- Cerca de mòduls per professor utilitzant `join`

---

### Transaccions

- Funcionalitat: crear **alumne + matrícula inicial** en una sola operació
- Tot el procés ha d’estar dins `DB::transaction()`
- Afegir una opció per simular un error llançant una excepció
- Comprovar que es fa **rollback** i no queda cap dada guardada

---

## Seeders (obligatoris)

Cal que el projecte inclogui **seeders obligatoris** per disposar de dades mínimes de prova. No és opcional.

### Seeders a crear

- `UserSeeder`: **3 usuaris** de prova (per accedir a l’aplicació amb Breeze)
  - Password per defecte: `123` (encriptat)
- `ProfessorSeeder`: **2 professors**
- `GrupSeeder`: **2 grups** (cada grup ha de tenir un `professor_id` vàlid; recorda que és `unique`)
- `AlumneSeeder`: **3 alumnes**


