## Ordre recomenat pel desenvolupupament del projecte

1. **Migracions**
2. **Models**
3. **Instalar Breeze** per fer els seeder de users
4. **Seeders**

5. **CRUD Professors**
   - 5.1 Rutes  
   - 5.2 Controlador  
   - 5.3 Vistes  
   *(En el primer CRUD també fer la vista de login i la navbar)*

6. **CRUD Grups**  
7. **CRUD Moduls**  
8. **CRUD Alumnes**

9. **Gestió de matrícules dins del CRUD d’Alumnes (pivot)**
   - checkboxes de mòduls  
   - camp de nota per cada mòdul  
   - `attach()` en crear  
   - `sync()` en editar  
   - mostrar `pivot->nota` als llistats  

10. **Filtres i consultes avançades**

   **Per alumnes**
   - Cerca per DNI o cognoms  
   - Filtre per nota mínima  
   - Operador AND / OR  
   - I que tot això funcioni amb la relació many-to-many (`alumne_modul.nota`)

   **Per professors**
   - Ordenació de Professors  

   **Per mòduls**
   - Cerca de mòduls per professor amb JOIN  

11. **Transaccions**

   Fer una funcionalitat que creï **Alumne** i la seva matrícula inicial  
   (`alumne_modul` amb notes) en **una sola operació**, dins `DB::transaction()`.

   I també una opció per simular un error (*exception*) per comprovar que es fa  
   **rollback** i **NO queda res guardat**.

---

## Tinker (Laravel) — Proves ràpides amb la BD

Tinker és una consola interactiva (REPL) que et permet executar codi PHP/Laravel directament dins del projecte, ideal per comprovar dades, provar consultes Eloquent i veure si seeders/migracions han funcionat.

### Com iniciar-lo

```bash
php artisan tinker
```

### Exemples bàsics (comptar registres)

```php
App\Models\Professor::count();
App\Models\Alumne::count();
App\Models\Grup::count();
App\Models\Modul::count();
```

### 🔍 Consultes per veure dades concretes (útil per verificar seeders)

```php
App\Models\Alumne::orderBy('id')->get(['id','dni','nom','cognoms']);
App\Models\Professor::orderBy('id')->get(['id','email','cognoms','nom']);
App\Models\Grup::orderBy('id')->get(['id','nom','aula','professor_id']);
```

---

## Ajudes per solucionar possibles problemes

### Netejar caché de Laravel

Quan hagis fet canvis i Laravel sembla que *“no els agafa”*  
(rutes, vistes, config…), pots netejar la caché amb:

```bash
php artisan optimize:clear
```

Això neteja (entre altres) la cache de configuració, rutes, vistes i events.

---

### Possibles problemes (Vite / Tailwind)

Canvis d’estil que *“no apareixen”* i no es reflecteixen a la web, normalment és perquè **no s’està recompilant el CSS**.

Les classes de Tailwind només existeixen dins del CSS que genera **Vite**.

Si no tens `npm run dev` actiu (o no has fet `npm run build`),  
el navegador pot estar carregant CSS antic i no veu les classes noves.

**Forma recomanada de treballar**

Durant el desenvolupament:

**Terminal 1**
```bash
php artisan serve
```

**Terminal 2**
```bash
npm run dev
```
