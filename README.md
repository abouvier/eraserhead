eraserhead
==========

Appropriateur® de code. Permet de changer le login et la date (dans une fourchette de deux heures avant maintenant) d'un code source doté d'un en-tête 42.

Exemple
-------
Pour s'approprier ce script :

	./eraserhead.php eraserhead.php judas

Pour s'approprier toute une libft (much appreciated) !

	find /chemin/vers/libft -type f -regex '.+\.[ch]$' -exec ./eraserhead.php {} \;
