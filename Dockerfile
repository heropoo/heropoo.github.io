from ruby:2.5

MAINTAINER	Heropoo "aiyouyou1000@163.com"

RUN gem install jekyll bundler

WORKDIR /srv/jekyll

CMD ["jekyll"]