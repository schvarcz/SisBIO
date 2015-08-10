# -*- coding:utf8 -*-
from pykml import parser


def showGeometry(geometry):
	pts = geometry.strip("\t").strip("\n").strip("\t") 
	pts = pts.split(' ')
	newPts = []
	for pt in pts:
		pt = pt.split(",")
		if len(pt) == 3:
			newPts.append(" ".join(pt[0:2]))

	coords = ",".join(newPts)
	if coords == None:
		return None
	return coords

# 	<Polygon>
# 		<altitudeMode>relativeToGround</altitudeMode>
# 		<outerBoundaryIs>
# 			<LinearRing>
# 				<coordinates>
# 					-50.17550771979931,-29.4754907335555,0 -50.1755081692913,-29.565491050911,0 -50.2655089152286,-29.5654907063369,0 -50.26550846507681,-29.4754903899313,0 -50.17550771979931,-29.4754907335555,0 -50.17550771979931,-29.4754907335555,0 
# 				</coordinates>
# 			</LinearRing>
# 		</outerBoundaryIs>
# 	</Polygon>
def showPolygon(poly):
	geom = showGeometry(str(poly.getchildren()[-1].getchildren()[-1].getchildren()[-1]))
	if geom == None:
		return geom
	return "POLYGON(("+geom+"))"


# <LineString>
# 	<coordinates>
# 		-55.95887672133307,-30.27547919965932,0 -55.95937522386026,-30.27560741069645,0 -55.95985636281911,-30.27552481691735,0 -55.96038405557332,-30.27551124009514,0 -55.96090726939379,-30.27558169345586,0 -55.96142445128812,-30.27557154540634,0 
# 	</coordinates>
# </LineString>
def showLineString(line):
	geom = showGeometry(str(line.getchildren()[-1]))
	if geom == None:
		return geom
	return "LineString("+geom+")"


# <Placemark>
# 	<name>UAR 1 - UAP1</name>
# 	<visibility>0</visibility>
# 	<open>1</open>
# 	<styleUrl>#m_ylw-pushpin1400</styleUrl>
# 	<Polygon>
# 		...
# 	</Polygon>
# </Placemark>
def showPlaceMark(place):
	polygon = name = None
	for f in place.getchildren():
		if f.tag.endswith("name"):
			# print f
			name = str(f.text.encode("utf-8")).strip("\n").strip()
			# print name
		if f.tag.endswith("MultiGeometry"):
			for ff in f.getchildren():
				if ff.tag.endswith("Polygon"):
					polygon = showPolygon(ff)
				
		if f.tag.endswith("Polygon"):
			polygon = showPolygon(f)
		if f.tag.endswith("LineString"):
			polygon = showLineString(f)

	if polygon != None:
		print "INSERT INTO UnidadeGeografica (Nome,shape,Data_Criacao, idProjeto,idPesquisador) VALUES (\""+ name+ "\",", "GeomFromText(\"",polygon,"\")", ",","NOW()",",2,1);"


def expand(folder):
	for f in folder.getchildren():
		if f.tag.endswith("Folder") or f.tag.endswith("Document"):
			# print f.name.text.encode("utf-8")
			expand(f)
		if f.tag.endswith("Placemark"):
			showPlaceMark(f)
		# else:
		# 	print f.tag

kml = parser.parse("Grades_Parcelas_PPBIO.kml")
# kml = parser.parse("SISBIOTA_UAR_UAP_UAL_16122014.kml")

root = kml.getroot()[0].getchildren()[-1].getchildren()[-1]
expand(root)



