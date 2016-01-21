sabre/dav-fastcgi
=================

This repository is an experiment to run sabre/dav as a FastCGI daemon. This
uses the [PHPFastCGI][5] project. Running directly off FastCGI could increase
throughput and reduce memory/cpu usage quite a bit.


Installation
------------

Make sure you have [composer][1] installed, and then run:

    composer require sabre/dav-fastcgi


Build status
------------

| branch | status |
| ------ | ------ |
| master | [![Build Status](https://travis-ci.org/fruux/sabre-dav-fastcgi.png?branch=master)](https://travis-ci.org/fruux/sabre-dav-fastcgi) |


Questions?
----------

Head over to the [sabre/dav mailinglist][2], or you can also just open a ticket
on [GitHub][3].


Made at fruux
-------------

This library is being developed by [fruux][4]. Drop us a line for commercial
services or enterprise support.

[1]: http://getcomposer.org/
[2]: http://groups.google.com/group/sabredav-discuss
[3]: https://github.com/fruux/sabre-dav-fastcgi/issues/
[4]: https://fruux.com/
[5]: https://github.com/PHPFastCGI/FastCGIDaemon
