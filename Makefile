.PHONY: all dev ci ci-install install build release watch start stop clean

all: install build

dev: install watch

ci: ci-install build

ci-install:
	composer install --no-dev --no-interaction --optimize-autoloader
	pnpm i

install:
	composer install
	pnpm i

build:
	pnpm build

release:
	mkdir -p release
	zip release/jcore-maailma.zip -r * -x @.zipexclude

watch:
	pnpm run watch

start:
	pnpm run env:start

stop:
	pnpm run env:stop

clean:
	rm -rf node_modules
	rm -rf build
	rm *.zip
