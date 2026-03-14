# Projecte de Síntesi – Desplegament d’Aplicacions Web (DAW)

[![Status](https://img.shields.io/badge/status-actiu-success)]()
[![Module](https://img.shields.io/badge/module-Desplegament%20d'Aplicacions%20Web-blue)]()
[![Level](https://img.shields.io/badge/level-2n%20DAW-orange)]()
[![Optional](https://img.shields.io/badge/CI/CD-opcional-lightgrey)]()

Repositori oficial del Projecte de Síntesi del mòdul de Desplegament d’Aplicacions Web.

Aquest projecte simula un escenari professional real:

> Rebre una aplicació funcional i convertir-la en un projecte professional, versionat correctament i desplegable.

---

## Objectius

L’alumnat haurà de demostrar que sap:

- Aplicar un workflow real amb Git (branques, merges, etiquetes).
- Provocar i resoldre conflictes de manera argumentada.
- Dockeritzar una aplicació web.
- Gestionar correctament configuració i variables d’entorn.
- Documentar decisions tècniques.
- Garantir una execució reproduïble.

Ampliació opcional:

- Integració Contínua (CI) amb GitHub Actions.
- Desplegament al núvol (CD bàsic).

---

## Roadmap del projecte

### Fase 1 – Professionalització del repositori
- Estructura correcta.
- `.gitignore` adequat.
- Workflow amb branques.
- Resolució de conflictes documentada.

### Fase 2 – Dockerització
- Dockerfile funcional.
- docker-compose operatiu.
- Variables d’entorn separades del codi.
- Execució amb `docker compose up --build`.

### Fase 3 – Documentació
- README clar.
- REPORT reflexiu.
- Evidències reals.

### Fase 4 (Opcional) – CI/CD
- Workflow amb GitHub Actions.
- Validació automàtica del build.
- Desplegament al núvol.

---

## Estructura del repositori

- [`enunciat-projecte-sintesi.md`](./enunciat-projecte-sintesi.md) → Enunciat oficial del projecte.
- [`REPORT.md`](./REPORT.md) → Estructura bàsica del document REPORT.
- [`annex-gestio-secrets.md`](./annex-gestio-secrets.md) → Gestió de secrets en entorns professionals.

---

## Modalitat

- Treball en parelles.
- Temps orientatiu: 12 hores 
- Lliurament: 
  - Repositori Git.
  - Defensa Oral
  - Documentació
  

---

## Filosofia

Aquest projecte no avalua si l’aplicació funciona.

Avalua si el projecte és:

- Col·laboratiu.
- Reproduïble.
- Configurat correctament.
- Documentat.
- Professional.

> **"It works on my machine"**  
> és desenvolupament.
>
> **"It is ready to deploy"**  
> és enginyeria.

---

## Nota sobre credencials

Les credencials utilitzades en aquest projecte són d’entorn local i no tenen valor real.

En entorns professionals:
- Els secrets no es versionen.
- Es gestionen mitjançant variables d’entorn o sistemes de gestió de secrets.