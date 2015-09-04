# -*- coding:utf8 -*-

sql = open("sql.sql").readlines()
relacoes = open("relacoes.sql").readlines()
lines = []
for i in range(len(sql)):
	sqlline = sql[i].replace("(Nome,shape,Data_Criacao, idProjeto,idPesquisador)","(`Nome`,`shape`,`Data_Criacao`,`idProjeto`,`idPesquisador`,`idUnidadeGeograficaPai`)").split(",")
	sqlline[-1] =  sqlline[-1].replace("\n","").replace(");","," + relacoes[i].split(",")[-1])
	lines.append(",".join(sqlline))

open("sql2.sql","w").writelines(lines)
