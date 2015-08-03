# -*- coding:utf8 -*-
from pykml import parser


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
	pts = str(poly.getchildren()[-1].getchildren()[-1].getchildren()[-1]).strip("\t").strip("\n").strip("\t") 
	pts = pts.split(' ')
	newPts = []
	for pt in pts:
		pt = pt.split(",")
		if len(pt) == 3:
			newPts.append(" ".join(pt[0:2]))

	coords = ",".join(newPts)
	if coords == None:
		return None
	return "POLYGON(("+coords+"))"


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
		elif f.tag.endswith("Polygon"):
			polygon = showPolygon(f)

	if polygon != None:
		print "INSERT INTO UnidadeGeografica (Nome,shape,Data_Criacao, idProjeto,idPesquisador) VALUES (\""+ name+ "\",", "PolygonFromText(\"",polygon,"\")", ",","NOW()",",1,1);"


def expand(folder):
	for f in folder.getchildren():
		if f.tag.endswith("Folder") or f.tag.endswith("Document"):
			# print f.name.text.encode("utf-8")
			expand(f)
		if f.tag.endswith("Placemark"):
			showPlaceMark(f)
		# else:
		# 	print f.tag

kml = parser.parse("SISBIOTA_UAR_UAP_UAL_16122014.kml")

root = kml.getroot()[0].getchildren()[-1].getchildren()[-1]
expand(root)



