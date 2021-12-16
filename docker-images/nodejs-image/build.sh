docker kill http-dynamic 2>/dev/null;
docker rm http-dynamic 2>/dev/null;
docker image rm api/http-dynamic 2>/dev/null;

docker build -t api/http-dynamic . ;

docker run -d \
        -p 1234:3000 \
        --name http-dynamic \
        api/http-dynamic