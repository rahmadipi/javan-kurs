# -*- coding: utf-8 -*-

# Define here the models for your scraped items
#
# See documentation in:
# http://doc.scrapy.org/en/latest/topics/items.html

import scrapy


#class BankItem(scrapy.Item):
    # define the fields for your item here like:
    # name = scrapy.Field()
#    pass

class BniItem(scrapy.Item):
	title = scrapy.Field()
	currency=scrapy.Field()
	sell = scrapy.Field()
	buy = scrapy.Field()
	pass
	
class BcaItem(scrapy.Item):
	title = scrapy.Field()
	count = scrapy.Field()
	erate1 = scrapy.Field()
	erate2 = scrapy.Field()
	ttcount1 = scrapy.Field()
	ttcount2 = scrapy.Field()
	bank1 = scrapy.Field()
	bank2 = scrapy.Field()
	pass
	
class MandiriItem(scrapy.Item):
	title = scrapy.Field()
	title1 = scrapy.Field()
	nilai = scrapy.Field()
	kurs = scrapy.Field()
	symbol = scrapy.Field()
	jual = scrapy.Field()
	beli = scrapy.Field()
	pass