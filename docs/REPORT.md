# REPORT – Projecte de Síntesi

## 1. Dades generals

Nom del projecte: gestio-insti-daw

Integrants: Souhaila Ezzarfi , Ricard

Tecnologia principal (Laravel / React / Fullstack): Laravel

Enllaç al repositori: git@github.com:souhailaezzarfi/gestio-insti-daw.git

Data d’entrega: 16/03/2026

## 2. Estat inicial del projecte

El projecte es trobava en un estat funcional a nivell local, però sense cap configuració de desplegament.

**Estructura inicial del repositori:**

- Fitxer `.gitignore` correcte (ignorava `vendor/` i `.env`)
- Fitxer `.env` i `.env.example` presents
- Projecte funcionant correctament en local

**Problemes detectats:**

- No hi havia cap configuració de Docker (`Dockerfile` ni `docker-compose.yml`)
- No estava connectat a cap repositori remot

**Reflexió:**
El projecte funcionava correctament en local però no es podia considerar professional perquè no tenia sistema de desplegament ni control de versions col·laboratiu.

## 3. Workflow Git aplicat

Expliqueu:

- Model de branques utilitzat
- Convencions de noms
- Estratègia de merge utilitzada
- Ús (o no) de rebase
- Incloeu exemples reals de commits rellevants (amb missatge i explicació del canvi).

**Model de branques utilitzat:**
Hem treballat amb dues branques principals a part de `main`:

- `feature/dockerizacion` (Souhaila) → dockerització i millores de l'aplicació
- `fix/documentation` (Ricard) → documentació i dependències del projecte

**Convencions de noms:**
Hem utilitzat el prefix `feature/` per a la branca principal de
desenvolupament i `fix/` per a correccions. Els missatges de commit
han estat majoritàriament en castellà, amb alguns seguint la
convenció de Conventional Commits (`feat:`, `fix:`, `chore:`).

**Estratègia de merge utilitzada:**

- El Conflicte 1 es va resoldre per terminal amb `git merge`
- El Conflicte 2 es va resoldre via Pull Request a GitHub

**Ús de rebase:**
No hem utilitzat rebase durant el projecte.

**Commits rellevants:**

- `feat: initial project setup` → primer commit amb l'estructura base del projecte Laravel
- `docs: add README and REPORT` → documentació inicial del projecte
- `feat: añadir Docker configuracion` → Dockerfile, docker-compose.yml i .env.example
- `fix: Cambiar PHP version de 8.2 a 8.3 en Dockerfile` → correcció de compatibilitat
- `fix: run migrationsy seeders en Dockerfile` → execució automàtica de migracions
- `Eliminado sistema de autenticación y roles. App ahora pública` → simplificació de l'aplicació
- `Añadida validación y errores en vistas de grupos` → millora de les vistes

## 4. Conflicte 1 – Mateixa línia

### 4.1 Com s’ha provocat

Expliqueu exactament quins canvis ha fet cada membre.

### 4.2 Missatge d’error generat

Incloeu la sortida real de Git.

### 4.3 Marcadors de conflicte

Mostreu el fragment amb:

```
<<<<<<< HEAD
=======
>>>>>>> branch
```

### 4.4 Resolució aplicada

Expliqueu:

- Quina decisió s’ha pres
- Per què s’ha escollit aquesta opció
- Com s’ha validat que funciona

### 4.5 Reflexió

Què heu après d’aquest conflicte?

## 5. Conflicte 2 – Dependències o estructura

### 5.1 Descripció del conflicte

Per provocar aquest conflicte, cadascun de nosaltres va afegir una
dependència diferent a la secció `require` del fitxer `composer.json`
des de la seva pròpia branca:

- Jo (Souhaila, branca `feature/dockerizacion`) vaig afegir manualment
  la dependència `spatie/laravel-permission: ^6.0`
- En Ricard (branca `fix/documentation`) va afegir manualment
  la dependència `spatie/laravel-activitylog: ^4.0`

### 5.2 Error generat

En obrir el Pull Request #4 a GitHub per fusionar `feature/dockerizacion`
a `main`, GitHub va detectar el conflicte i va mostrar:

### 5.3 Resolució aplicada

Vam decidir mantenir les dues dependències al `composer.json` final
ja que les dues són útils per al projecte. Vaig eliminar els marcadors
de conflicte des de l'editor web de GitHub i vaig fer clic a
"Mark as resolved" i "Commit merge".

### 5.4 Diferències respecte al conflicte anterior

A diferència del Conflicte 1 que vam resoldre per terminal, aquest
el vam resoldre directament des de l'editor web de GitHub, deixant
evidència visual del procés al Pull Request #4.

## 6. Dockerització

### 6.1 Arquitectura final

Descriviu els serveis definits a docker-compose.yml.

El `docker-compose.yml` defineix dos serveis:

- **app**: Conté l'aplicació Laravel. Es construeix a partir del
  `Dockerfile` del projecte, exposa el port 8000 i rep les variables
  de connexió a la base de dades via variables d'entorn.

- **db**: Conté la base de dades MySQL 8.0. Utilitza la imatge
  oficial de MySQL, crea la base de dades `gestio_insti` i l'usuari
  `laravel` automàticament en el primer arrencament.

Els dos serveis es comuniquen a través de la xarxa interna de Docker,
on el servei `app` es connecta al servei `db` pel nom d'host `db`.

### 6.2 Variables d’entorn

Expliqueu quines variables són necessàries i per què no es versiona el .env.

Les variables necessàries per executar el projecte són:

- `DB_CONNECTION` → tipus de base de dades (mysql)
- `DB_HOST` → nom del servei de base de dades (db)
- `DB_PORT` → port de connexió (3306)
- `DB_DATABASE` → nom de la base de dades (gestio_insti)
- `DB_USERNAME` → usuari de la base de dades (laravel)
- `DB_PASSWORD` → contrasenya de la base de dades

El fitxer `.env` no es versiona perquè conté credencials sensibles
que no han d'estar mai en un repositori públic. En el seu lloc,
el repositori inclou un `.env.example` amb les variables necessàries
però sense valors secrets reals.

### 6.3 Persistència (si s'escau)

Expliqueu l’ús de volums.

El projecte utilitza dos volums:

- **db_data**: Volum gestionat per Docker que persisteix les dades
  de MySQL. Això garanteix que les dades no es perden quan el
  contenidor s'atura o es reinicia.

- **./storage**: La carpeta `storage` de Laravel es munta com a
  volum local per persistir els fitxers pujats pels usuaris
  (com ara les fotos dels professors).

### 6.4 Problemes trobats

**Problema 1: composer.lock desactualitzat**

En executar `docker compose up --build` per primera vegada,
vam obtenir el següent error:

```
Required package "spatie/laravel-permission" is not present in the lock file.
Required package "spatie/laravel-activitylog" is not present in the lock file.
Required (in require-dev) package "barryvdh/laravel-debugbar" is not present in the lock file.
This usually happens when composer files are incorrectly merged or
the composer.json file is manually edited.
```

**Causa:** Vam afegir les dependències manualment al `composer.json`
sense executar `composer update`, per la qual cosa el fitxer
`composer.lock` no estava sincronitzat amb el `composer.json`.

**Solució:** Vam executar `composer update` en local per actualitzar
el `composer.lock` i vam fer commit dels dos fitxers:

```bash
composer update
git add composer.json composer.lock
git commit -m "chore: Modificar composer.lock con nuevas dependencias"
```

**Problema 2: Incompatibilitat de versió de PHP**

En tornar a executar `docker compose up --build`, vam obtenir errors
de compatibilitat amb múltiples paquets com `pestphp/pest`,
`phpunit/phpunit` i `sebastian/*` que requereixen PHP >= 8.3
però el Dockerfile utilitzava PHP 8.2:

```
pestphp/pest v4.4.2 requires php ^8.3.0 -> your php version (8.2.30)
does not satisfy that requirement.
```

**Causa:** El `composer.lock` del projecte tenia dependències que
requereixen PHP 8.3 però el `Dockerfile` estava configurat amb PHP 8.2.

**Solució:** Vam canviar la imatge base del `Dockerfile` de
`php:8.2-fpm` a `php:8.3-fpm`:

```dockerfile
FROM php:8.3-fpm
```

**Problema 3: Port 3306 ja en ús**

En intentar aixecar els contenidors, vam obtenir el següent error:

```
failed to bind host port 0.0.0.0:3306/tcp: address already in use
```

**Causa:** La màquina local ja tenia un servei MySQL corrent
al port 3306, per la qual cosa Docker no podia usar el mateix port.

**Solució:** Vam canviar el port extern de MySQL al `docker-compose.yml`
de `3306:3306` a `3307:3306`, mantenint el port intern del
contenidor en 3306:

```yaml
ports:
    - "3307:3306"
```

Això permet que Docker usi el port 3307 externament sense
interferir amb el MySQL local.

**Problema 4: Taules de la base de dades no existents**

En accedir a `http://localhost:8000` vam obtenir el següent error:

```
SQLSTATE[42S02]: Base table or view not found: 1146
Table 'gestio_insti.sessions' doesn't exist
```

**Causa:** La base de dades MySQL s'iniciava buida, sense les taules
necessàries per a Laravel ni les dades inicials.

**Solució:** Vam modificar el `CMD` del `Dockerfile` per executar
automàticament les migracions i els seeders en arrencar el contenidor:

```dockerfile
CMD bash -c "until php artisan migrate --force 2>/dev/null; do echo 'Waiting for database...'; sleep 3; done && php artisan serve --host=0.0.0.0 --port=8000"

```

## 7. Prova de desplegament des de zero

Expliqueu els passos exactes que hauria de seguir una persona externa:

- Clonar repositori
- Executar comanda
- Accedir a l’aplicació

Indiqueu també:

- Ports utilitzats
- Credencials de prova (si n’hi ha)

Una persona externa pot executar el projecte seguint aquests passos:

**1. Clonar el repositori**

```bash
git clone git@github.com:souhailaezzarfi/gestio-insti-daw.git
cd gestio-insti-daw
```

**2. Executar el projecte amb Docker**

```bash
docker compose up --build
```

**3. Accedir a l'aplicació**

Obrir el navegador i anar a:

```
http://localhost:8000
```

**Ports utilitzats:**

- `8000` → Aplicació Laravel
- `3307` → MySQL (accessible externament)

**Requisits previs:**

- Docker instal·lat
- Port 8000 i 3307 lliures

**Notes:**

- Les migracions s'executen automàticament.
- No cal instal·lar PHP, Composer ni Node.js localment.
- Per aturar: `docker compose down`
- Per aturar i eliminar dades: `docker compose down -v`

## 8. Repartiment de tasques

Descriviu què ha fet cada membre de l’equip.

## 9. Temps invertit

Indiqueu aproximadament:

- Temps dedicat a Git
- Temps dedicat a Docker
- Temps dedicat a documentació

## 10. Reflexió final

Responeu breument:

- Quina ha estat la part més complexa?
- Què faríeu diferent en un projecte real?
- Heu entès realment com funcionen els conflictes i Docker?
