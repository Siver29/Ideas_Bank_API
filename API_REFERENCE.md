# Syrian Investment Ideas Bank — API Reference

This document describes every public REST endpoint provided by the **Syrian Investment Ideas Bank** API. It is intended for students building the frontend, so they can consume the API without reading the backend source code.

## General Information

- **Base URL:** `http://localhost:8000/api/v1`
- **Format:** JSON
- **Authentication:** None (all endpoints are public and read-only)
- **Language:** All resources are **bilingual** (English + Arabic fields).

### Important design decision

This backend intentionally provides **complete, unpaginated** datasets. The frontend is responsible for performing **search, filtering, sorting, and pagination locally** in the browser. Therefore:

- The endpoints below accept **no query parameters** for narrowing results.
- If you pass query parameters to the project-list endpoint, the API returns a `422` error explaining that the frontend handles those features.

### Response envelope

Every successful response uses a consistent envelope:

```json
{
  "success": true,
  "data": []
}
```

For a single resource, `data` is an object; for a list, `data` is an array.

### Error responses

| Status | Meaning |
|--------|---------|
| `404` | The requested resource does not exist or is not active. Returns `{ "success": false, "message": "Resource not found." }` |
| `422` | Invalid request (for example, unsupported query parameters on the project list). Returns `{ "success": false, "message": "...", "errors": { ... } }` |

---

## Endpoint Summary

| Method | URI | Description |
|--------|-----|-------------|
| GET | `/investment-projects` | List all active investment projects (summary) |
| GET | `/investment-projects/{id}` | View one active investment project (full detail) |
| GET | `/investment-categories` | List active investment categories |
| GET | `/investment-categories/{id}` | View one investment category |
| GET | `/governorates` | List active Syrian governorates |
| GET | `/governorates/{id}` | View one governorate |
| GET | `/governorates/{id}/cities` | List the active cities of a governorate |
| GET | `/cities` | List all active cities |
| GET | `/cities/{id}` | View one city |
| GET | `/machinery` | List machinery in the equipment catalogue |
| GET | `/machinery/{id}` | View one piece of machinery |

---

## 1. List Investment Projects

`GET /investment-projects`

Returns a **summary** of all active investment projects. The full dataset is returned so the frontend can perform search, filtering, sorting, and pagination locally.

**Request:**

```http
GET /api/v1/investment-projects
Accept: application/json
```

**Example response (200):**

```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "title_en": "Smart Agriculture Greenhouse",
      "title_ar": "بيت بلاستيكي ذكي",
      "brief_description_en": "A modern greenhouse using smart irrigation.",
      "brief_description_ar": "بيت بلاستيكي حديث يعمل بالري الذكي.",
      "category": {
        "id": 1,
        "name_en": "Agriculture",
        "name_ar": "زراعة",
        "slug": "agriculture",
        "description_en": "Agricultural investment opportunities.",
        "description_ar": "فرص استثمارية زراعية.",
        "icon": "leaf"
      },
      "governorate": {
        "id": 1,
        "name_en": "Damascus",
        "name_ar": "دمشق",
        "code": "DM"
      },
      "city": {
        "id": 1,
        "governorate_id": 1,
        "name_en": "Damascus",
        "name_ar": "دمشق"
      },
      "required_capital": "150000.00",
      "currency": "USD",
      "capital_tier": "medium",
      "expected_profit_rate_min": "20.00",
      "expected_profit_rate_max": "30.00",
      "expected_profit_rate_text": "20-30%",
      "expected_return_period_months": 36,
      "is_quick_return": false,
      "image_url": "http://localhost:8000/storage/projects/1.jpg",
      "latitude": "33.5138000",
      "longitude": "36.2765000"
    }
  ]
}
```

> The categories are one of: `technology`, `agriculture`, `industry`, `commerce`. The capital tier is one of: `small`, `medium`, `large`.

### Unsupported query parameters

Because search/filtering/sorting/pagination are handled by the frontend, sending query parameters returns a `422`:

**Request:**

```http
GET /api/v1/investment-projects?category_id=1&sort=newest
```

**Example response (422):**

```json
{
  "success": false,
  "message": "Search, filtering, sorting, and pagination are handled by the frontend. This endpoint does not accept query parameters.",
  "errors": {
    "query": [
      "Unsupported query parameters were provided."
    ]
  }
}
```

---

## 2. Show Investment Project

`GET /investment-projects/{id}`

Returns the **full detail** of one active investment project, including machinery requirements, location coordinates, and image.

**Request:**

```http
GET /api/v1/investment-projects/1
Accept: application/json
```

**Example response (200):**

```json
{
  "success": true,
  "data": {
    "id": 1,
    "title_en": "Smart Agriculture Greenhouse",
    "title_ar": "بيت بلاستيكي ذكي",
    "brief_description_en": "A modern greenhouse using smart irrigation.",
    "brief_description_ar": "بيت بلاستيكي حديث يعمل بالري الذكي.",
    "full_details_en": "A complete modern greenhouse project with automated irrigation and climate control systems.",
    "full_details_ar": "مشروع بيت بلاستيكي حديث متكامل مع أنظمة ري وتنظيم مناخ آلي.",
    "category": {
      "id": 1,
      "name_en": "Agriculture",
      "name_ar": "زراعة",
      "slug": "agriculture",
      "description_en": "Agricultural investment opportunities.",
      "description_ar": "فرص استثمارية زراعية.",
      "icon": "leaf"
    },
    "governorate": {
      "id": 1,
      "name_en": "Damascus",
      "name_ar": "دمشق",
      "code": "DM"
    },
    "city": {
      "id": 1,
      "governorate_id": 1,
      "name_en": "Damascus",
      "name_ar": "دمشق"
    },
    "required_capital": "150000.00",
    "currency": "USD",
    "capital_tier": "medium",
    "expected_profit_rate_min": "20.00",
    "expected_profit_rate_max": "30.00",
    "expected_profit_rate_text": "20-30%",
    "expected_return_period_months": 36,
    "location_description_en": "Near the eastern entrance of the city.",
    "location_description_ar": "قرب المدخل الشرقي للمدينة.",
    "latitude": "33.5138000",
    "longitude": "36.2765000",
    "is_quick_return": false,
    "image_url": "http://localhost:8000/storage/projects/1.jpg",
    "machinery": [
      {
        "id": 1,
        "name_en": "Drip Irrigation System",
        "name_ar": "نظام ري بالتنقيط",
        "description_en": "Automated drip irrigation equipment.",
        "description_ar": "معدات ري بالتنقيط آلي.",
        "quantity": 2,
        "notes_en": "High-capacity units.",
        "notes_ar": "وحدات عالية السعة."
      }
    ],
    "created_at": "2026-01-01T00:00:00.000000Z",
    "updated_at": "2026-01-01T00:00:00.000000Z"
  }
}
```

**Example response (404)** — when the id does not exist or the project is not active:

```json
{
  "success": false,
  "message": "Resource not found."
}
```

---

## 3. List Investment Categories

`GET /investment-categories`

Returns all active investment categories (`technology`, `agriculture`, `industry`, `commerce`).

**Request:**

```http
GET /api/v1/investment-categories
Accept: application/json
```

**Example response (200):**

```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "name_en": "Technology",
      "name_ar": "تقانة",
      "slug": "technology",
      "description_en": "Technology-related investment opportunities.",
      "description_ar": "فرص استثمارية في مجال التقانة.",
      "icon": "cpu"
    }
  ]
}
```

---

## 4. Show Investment Category

`GET /investment-categories/{id}`

Returns a single active investment category.

**Request:**

```http
GET /api/v1/investment-categories/1
Accept: application/json
```

**Example response (200):**

```json
{
  "success": true,
  "data": {
    "id": 1,
    "name_en": "Technology",
    "name_ar": "تقانة",
    "slug": "technology",
    "description_en": "Technology-related investment opportunities.",
    "description_ar": "فرص استثمارية في مجال التقانة.",
    "icon": "cpu"
  }
}
```

**Example response (404):**

```json
{
  "success": false,
  "message": "Resource not found."
}
```

---

## 5. List Governorates

`GET /governorates`

Returns all active Syrian governorates.

**Request:**

```http
GET /api/v1/governorates
Accept: application/json
```

**Example response (200):**

```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "name_en": "Damascus",
      "name_ar": "دمشق",
      "code": "DM"
    },
    {
      "id": 2,
      "name_en": "Aleppo",
      "name_ar": "حلب",
      "code": "AL"
    }
  ]
}
```

---

## 6. Show Governorate

`GET /governorates/{id}`

Returns a single active governorate.

**Request:**

```http
GET /api/v1/governorates/1
Accept: application/json
```

**Example response (200):**

```json
{
  "success": true,
  "data": {
    "id": 1,
    "name_en": "Damascus",
    "name_ar": "دمشق",
    "code": "DM"
  }
}
```

**Example response (404):**

```json
{
  "success": false,
  "message": "Resource not found."
}
```

---

## 7. List Governorate Cities

`GET /governorates/{id}/cities`

Returns the active cities belonging to the given governorate.

**Request:**

```http
GET /api/v1/governorates/1/cities
Accept: application/json
```

**Example response (200):**

```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "governorate_id": 1,
      "name_en": "Damascus",
      "name_ar": "دمشق"
    },
    {
      "id": 2,
      "governorate_id": 1,
      "name_en": "Douma",
      "name_ar": "دوما"
    }
  ]
}
```

**Example response (404)** — when the governorate does not exist or is inactive:

```json
{
  "success": false,
  "message": "Resource not found."
}
```

---

## 8. List All Cities

`GET /cities`

Returns all active cities across all governorates. Each city includes its `governorate_id`.

**Request:**

```http
GET /api/v1/cities
Accept: application/json
```

**Example response (200):**

```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "governorate_id": 1,
      "name_en": "Damascus",
      "name_ar": "دمشق"
    },
    {
      "id": 2,
      "governorate_id": 1,
      "name_en": "Douma",
      "name_ar": "دوما"
    }
  ]
}
```

---

## 9. Show City

`GET /cities/{id}`

Returns a single active city.

**Request:**

```http
GET /api/v1/cities/1
Accept: application/json
```

**Example response (200):**

```json
{
  "success": true,
  "data": {
    "id": 1,
    "governorate_id": 1,
    "name_en": "Damascus",
    "name_ar": "دمشق"
  }
}
```

**Example response (404):**

```json
{
  "success": false,
  "message": "Resource not found."
}
```

---

## 10. List Machinery

`GET /machinery`

Returns all machinery in the equipment catalogue. This is a shared catalogue used to describe machinery requirements on investment projects.

**Request:**

```http
GET /api/v1/machinery
Accept: application/json
```

**Example response (200):**

```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "name_en": "Drip Irrigation System",
      "name_ar": "نظام ري بالتنقيط",
      "description_en": "Automated drip irrigation equipment.",
      "description_ar": "معدات ري بالتنقيط آلي."
    }
  ]
}
```

---

## 11. Show Machinery

`GET /machinery/{id}`

Returns a single piece of machinery.

**Request:**

```http
GET /api/v1/machinery/1
Accept: application/json
```

**Example response (200):**

```json
{
  "success": true,
  "data": {
    "id": 1,
    "name_en": "Drip Irrigation System",
    "name_ar": "نظام ري بالتنقيط",
    "description_en": "Automated drip irrigation equipment.",
    "description_ar": "معدات ري بالتنقيط آلي."
  }
}
```

---

## Frontend Integration Tips

- The project list (`GET /investment-projects`) returns the **complete** active dataset. Perform search, filtering, sorting, and pagination **in the browser**.
- Use the `category` object (with `slug`) to filter by category: `technology`, `agriculture`, `industry`, `commerce`.
- Use `capital_tier` to filter by capital size: `small`, `medium`, `large`.
- Use `governorate` and `city` to filter by location.
- Use `expected_profit_rate_text` for a display-ready profit rate (for example, `"20-30%"`).
- Use `image_url` to render the project image. It may be `null` when no image is available.
- Use `latitude` and `longitude` to place the project on a map.
- The `machinery` array (available on the detail endpoint) lists machinery requirements with per-project `quantity` and optional notes.
- Manage **favorites locally** in the frontend (e.g., `localStorage`); there is no favorites API.
