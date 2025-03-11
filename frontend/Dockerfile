
FROM node:18-slim


WORKDIR /app


COPY package*.json ./


RUN npm install

RUN npm install @rollup/rollup-linux-x64-gnu --no-save


COPY . .


EXPOSE 5173


CMD ["npm", "run", "dev", "--", "--host", "0.0.0.0"]
