docker kill http-infra 2>/dev/null;
docker rm http-infra 2>/dev/null;
docker image rm api/http-infra 2>/dev/null;

docker build -t api/http-infra . ;

docker run -d \
        -p 80:80 \
        --name http-infra \
        api/http-infra