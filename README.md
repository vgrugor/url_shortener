<h1>URL shortener</h1>
<p>A URL shortener is a simple tool that takes a long URL and turns it into whatever URL you would like it to be.</p>

<h2>Already implemented functionality</h2>
<ul style="list-style-type: none">
    :heavy_check_mark: oauth login (via github)<br>
    :heavy_check_mark: short link form<br> 
    :heavy_check_mark: secret short ulrs<br> 
    :heavy_check_mark: named short urls<br> 
    :heavy_check_mark: add black list for short keys<br>
    :heavy_check_mark: ttl to short urls (delete after some time)<br>
    :heavy_check_mark: ensure, that short key will not be rewriten<br>
    :heavy_check_mark: ensure, that mysql returns case sensitive result<br>
    :heavy_check_mark: add api<br>
    :heavy_check_mark: add statistic<br>
</ul>

<h2>The following features are planned to be added</h2>
<ul style="list-style-type: none">
    :o: add logs via ELK stack<br>
    :o: add redis for caching urls<br>
    :o: add monitoring via graphana<br>
    :o: add top visited urls by monthes<br>
    :o: add letsencrypt ssl certificate (https)<br>
    :o: add load balancer and two shortener instances (traefic or common nginx instance)<br>
</ul>

<h2>How to launch a project</h2>

1. Clone project

    ```
    git clone git@github.com:vgrugor/url_shortener.git
    ```

2. Go to the folder with the project
    ```
    cd url_shortener
    ```
3. Set the dependencies:<br>
- If composer is installed locally, run
    ```
    composer install --ignore-platform-reqs
    ```
- If you have docker installed locally, run the command
    ```
    docker run --rm \<br>
      -u "$(id -u):$(id -g)" \<br>
      -v $(pwd):/opt \<br>
      -w /opt \<br>
      laravelsail/php80-composer:latest \<br>
      composer install --ignore-platform-reqs
    ```
4. Create a file with the environment settings:
    ```
    cp .env.example .env
    ```
5. Generate Application Key
    ```
    php artisan key:generate
    ```
6. Build a Docker image
    ```
    ./vendor/bin/sail build --no-cache
    ```
7. Run Sail
    ```
    ./vendor/bin/sail up -d
    ```
8. Install npm
    ```
   ./vendor/bin/sail npm install
    ```
9. Run migrations
    ```
    ./vendor/bin/sail artisan migrate
    ```
10. to use github auth - create github application, copy and paste github_client_id and github_client_secret to .env
