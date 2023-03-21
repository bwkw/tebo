# イメージをビルドするためのベースイメージを設定する（https://hub.docker.com/_/php）
FROM php:8.2-rc-fpm

# RUNはコンテナビルド時に実行するコマンドを書く
## && で複数のコマンドをつなぎ、 \ で改行する
### apt-get update ：インストール可能なパッケージの「一覧」を更新
### apt-get -y install：パッケージをインストール
### docker-php-ext-install：PHPの拡張ライブラリをインストール（※Laravelのインストールや開発に必要な（もしくは便利な）パッケージや拡張ライブラリをインストール）
RUN apt-get update && \
    apt-get -y install --no-install-recommends \
      git \
      unzip \
      libzip-dev \
      libicu-dev \
      libonig-dev && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* && \
    pecl install xdebug && \
    docker-php-ext-enable xdebug && \
    docker-php-ext-install intl pdo_mysql zip bcmath

COPY ./infra/docker/app/php.ini /usr/local/etc/php/php.ini
# ローカルで（後ほど）作成する php.ini （PHPの設定ファイル）をDockerコンテナ内にコピー
# COPY [ローカル側のパス] [コンテナ側のパス]（ローカル側のパスはbuildコマンドを実行するディレクトリからのパス）

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
# Laravelを使うためComposerをインストール
# マルチステージビルドと言われ、イメージの軽量化に役立つみたい（https://docs.docker.com/develop/develop-images/multistage-build/）

WORKDIR /app
# コンテナを起動している時に $ docker-compose exec コンテナ名 bash というコマンドを実行すると、コンテナの中でbashを実行することができる。
# WORKDIRはその時のカレントディレクトリを指定する
