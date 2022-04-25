TicTacToe
===============================

Backend (Symfony + Ratchet)
----------------------------
Requirements:
* PHP "^8.0"
* Composer "^2.0"

Start server:
* composer install (only for the first run)
* bin/console ttt:server:start

To run all checks (static analysis, code-style, tests),
please run `composer check` command inside the `backend` module 

Frontend (Vue)
----------------------------
Requirements:
* Node "^12.13.0 || ^14.15.0 || >=16"
* Yarn "^1.19"

Start server:
* yarn install (only for the first run)
* yarn serve
