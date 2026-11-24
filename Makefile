# Ambiente de desenvolvimento do plugin Fichas IDB.
#
#   make dev_playground                 # WordPress Playground em http://127.0.0.1:9400 com o blueprint
#   make dev_playground PHP=8.4         # outra versão do PHP
#   make dev_playground RESET=1         # apaga o site salvo e recria do zero
#   make dev_playground BLUEPRINT=outro.json PORT=9500

PLAYGROUND ?= npx --yes @wp-playground/cli@latest
BLUEPRINT  ?= playground/blueprint.json
PORT       ?= 9400
PHP        ?= 8.3
WP         ?= latest
RESET      ?=

.PHONY: dev_playground

dev_playground:
	@test -f "$(BLUEPRINT)" || { echo "Blueprint não encontrado: $(BLUEPRINT)"; exit 1; }
	$(PLAYGROUND) start \
		--blueprint=$(BLUEPRINT) \
		--port=$(PORT) \
		--php=$(PHP) \
		--wp=$(WP) \
		--skip-browser \
		$(if $(RESET),--reset,)
