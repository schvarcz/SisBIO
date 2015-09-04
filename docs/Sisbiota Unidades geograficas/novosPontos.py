# -*- coding:utf-8 -*-

import utm
from math import sqrt

def textToCoords(line):
	line = line[line.find("(")+1:line.find(")")]
	latLngPoint =  [[float(coord) for coord in point.split(" ")][::-1] for point in line.split(",")]
	utmPoints = [ list(utm.from_latlon(coord[0],coord[1])) for coord in latLngPoint] 
	return utmPoints

def distancia(p1,p2):
	return sqrt((p2[0]-p1[0])**2  +   (p2[1]-p1[1])**2)

medicoes = [12, 37, 62, 87, 112, 137, 162, 187, 212, 237]

lines = open("linestring.csv").readlines()
for line in lines:
	line = line.split(";")
	utmPoints =  textToCoords(line[7])

	distSum = 0
	for idxBase in range(len(utmPoints)-1):
		distSum += distancia(utmPoints[idxBase],utmPoints[idxBase+1])

	if  not 240 < distSum < 260:
		print distSum, ",", line[1]
	idxBase = distSum = ua = 0
	for dist in medicoes:
		while  distSum + distancia(utmPoints[idxBase],utmPoints[idxBase+1]) < dist and idxBase < len(utmPoints)-2:
			distSum += distancia(utmPoints[idxBase],utmPoints[idxBase+1])
			idxBase += 1
		perct = (dist - distSum)/distancia(utmPoints[idxBase],utmPoints[idxBase+1])
		point =  map(lambda c: perct*(utmPoints[idxBase+1][c] - utmPoints[idxBase][c]) + utmPoints[idxBase][c], range(2)) + utmPoints[idxBase][2:]
		#print point
		point = utm.to_latlon(point[0],point[1],point[2],point[3])
		#print "INSERT INTO UnidadeGeografica(Nome,shape,Data_Criacao, idProjeto,idPesquisador,idUnidadeGeograficaPai)  VALUES ('{4} UA-{0}', GeomFromText('POINT({3} {2})'), NOW(),2,1,{1});".format(ua, line[0],point[0], point[1],line[1])
		ua += 1


