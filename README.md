# minimizing-url

Минимизатор URL
Необходимо реализовать возможность ввода пользователем URL с целью минификации, и полем с указанием времени жизни ссылки. Сервис должен предоставлять статистику переходов по ссылке.
Реализация на РНР, симфони.

# QUICK START
1. Install [docker](https://docs.docker.com/engine/install/ubuntu/).
2. Install [docker-compose](https://docs.docker.com/compose/install/).
3. Add docker in [sudo group](https://stackoverflow.com/a/48957722/11419254), perform ALL steps except the fourth.

COMMAND
---
```
Для роботи команд перейти в папку - cd devenv 

make up - підняти контейнери

make down - опустити контейнери

make migrate - підняти міграції
```