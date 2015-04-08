#!/usr/bin/python
import csv

def loadCsv(path):
    inserts = []
    for l in csv.reader(open(path,"r"),delimiter=","):
        line = []
        for c in l:
            c = " ".join([s.capitalize() for s in c.split(" ")])
            if c.find("-") > 0:
                c = "-".join([s.capitalize() for s in c.split("-")])
            line.append(c.replace("'","\\'"))
            
        inserts.append(tuple(line))
    return tuple(inserts)
    
    
def generateInsert(tableName, formatFields):
    inserts = loadCsv("%s.csv" % tableName)
    sql = "INSERT INTO %s VALUES " % tableName.capitalize()
    for l in inserts:
        sql += formatFields % l
        
    return sql
    
    
def outputSql(tableName, formatFields):
    sql = generateInsert(tableName, formatFields)[:-3]
    open("%s.sql"%tableName,"w").write(sql)
    return sql

print outputSql("ordem","(%s,'%s','%s','%s',%s),\n\t")
print outputSql("familia","(%s,'%s','','',%s),\n\t")
print outputSql("genero","(%s,'%s','','',%s),\n\t")
print outputSql("especie","(%s,'%s','%s','%s','%s',%s, %s),\n\t")
