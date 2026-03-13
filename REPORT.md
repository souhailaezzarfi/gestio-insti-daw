# REPORT – Projecte de Síntesi

## 1. Dades generals

Nom del projecte: gestio-insti-daw

Integrants: Souhaila Ezzarfi , Ricard Vergés 

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

**Branques creades:**
- `main` → branca principal, no es modifica directament
- `feature/dockerizacion` (Souhaila) → dockerització de l'aplicació
- `fix/documentacion` (Ricard) → documentació del projecte

**Commits inicials:**

- `feat: initial project setup` → primer commit amb l'estructura base del projecte Laravel

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

### 5.2 Error generat

### 5.3 Resolució aplicada

### 5.4 Diferències respecte al conflicte anterior

## 6. Dockerització

### 6.1 Arquitectura final

Descriviu els serveis definits a docker-compose.yml.

### 6.2 Variables d’entorn

Expliqueu quines variables són necessàries i per què no es versiona el .env.

### 6.3 Persistència (si s'escau)

Expliqueu l’ús de volums.

###  6.4 Problemes trobats

Incloeu errors reals i com s’han resolt.

## 7. Prova de desplegament des de zero

  Expliqueu els passos exactes que hauria de seguir una persona externa:
- Clonar repositori
- Executar comanda
- Accedir a l’aplicació  

Indiqueu també:
- Ports utilitzats 
```
Els ports principals utilitzats per l’aplicació són:

8000 → servidor web de l’aplicació (Laravel / Nginx)

3306 → base de dades MySQL (si s’exposa externament)
```
- Credencials de prova (si n’hi ha)

## 8. Repartiment de tasques

Descriviu què ha fet cada membre de l’equip.

## 9. Temps invertit

Indiqueu aproximadament:
- Temps dedicat a Git: aproximadament entre unes 5 i 6 hores.
- Temps dedicat a Docker:
- Temps dedicat a documentació: 

## 10. Reflexió final

Responeu breument:

- Quina ha estat la part més complexa?
```
Git, perquè a mi (Ricard), no hem sortia el mateix que a la companya Souhaila, i ens va tenir més temps entretinguts que tot anés bé, i la meva branca de treball estigués bé.
```
- Què faríeu diferent en un projecte real?
```
En un projecte real, el grup aplicaria una planificació encara més estricta des del principi. Tot i que en aquest projecte s’han utilitzat branques, merges i resolució de conflictes, s’ha vist que moltes incidències apareixen quan no es coordinen prou bé els canvis que fa cada membre.
```
- Heu entès realment com funcionen els conflictes i Docker?
```
Pel que fa als conflictes de Git, hem aprés, i considerem que sí que s’ha entès el seu funcionament de manera pràctica. Abans de fer aquest projecte, els conflictes es veien com un error difícil d’interpretar, però després de provocar-los i resoldre’ls manualment s’ha entès millor per què es produeixen, com identificar els marcadors de conflicte i com decidir quina versió del codi s’ha de mantenir.

Especialment, s’ha après que Git no “s’equivoca”, sinó que simplement no pot decidir automàticament quan dues branques modifiquen la mateixa part d’un fitxer o quan hi ha canvis incompatibles en fitxers com composer.json. Aquesta part ha estat útil perquè s’ha treballat sobre casos reals del projecte.

Pel que fa a Docker, el grup també considera que s’ha entès millor la seva utilitat dins del desplegament d’una aplicació. En aquest cas, la part principal de dockerització ha estat treballada sobretot per una de les integrants del grup, però el procés global ha servit per entendre millor com es defineixen els serveis, com es configuren els contenidors i com es pot executar el projecte d’una manera més reproduïble en diferents equips.

Per tant, la conclusió del grup és que sí, hem assolit una comprensió més real, tant dels conflictes de Git com del paper a fer Docker en un projecte professional, tot i que encara hi ha marge de millora i més pràctica per consolidar alguns conceptes més.
```