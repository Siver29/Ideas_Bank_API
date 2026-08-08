# Syrian Investment Ideas Bank — Database Structure Phase TODO

## Migrations
- [x] Create governorates migration
- [x] Create cities migration
- [x] Create investment_categories migration
- [x] Create investment_projects migration
- [x] Create machinery migration
- [x] Create investment_project_machinery pivot migration

## Enum & Models
- [x] Create CapitalTier enum
- [x] Create Governorate model
- [x] Create City model
- [x] Create InvestmentCategory model
- [x] Create InvestmentProject model
- [x] Create Machinery model

## Factories
- [x] Create GovernorateFactory
- [x] Create CityFactory
- [x] Create InvestmentCategoryFactory
- [x] Create InvestmentProjectFactory
- [x] Create MachineryFactory

## Seeders
- [x] Create GovernorateSeeder (14 governorates)
- [x] Create CitySeeder (25+ cities)
- [x] Create InvestmentCategorySeeder (4 categories)
- [x] Create MachinerySeeder (12 machinery)
- [x] Create InvestmentProjectSeeder (40+ projects + pivot)
- [x] Update DatabaseSeeder

## Tests
- [x] Create DataModelTest (relationships, pivot, enum, seed invariants)

## Validation & Git
- [x] Run optimize:clear, migrate:fresh --seed, test, pint --test
- [ ] Review git status/diff, commit, push
