from Dictionary import Dictionary
def getText():
    textFile = open("inputSlideshowText.txt","r")
    fullText = textFile.read()
    textFile.close()

    return fullText

# takes a list of chars that it should split the text one
def splitListOnChrs(text, splitChrs):
    for char in splitChrs: 
        # changing everything to ~~!! then going to split it
        text = text.replace(char, "dlfjaskdfjlsja")
    return text.split("dlfjaskdfjlsja")    

sentences = splitListOnChrs(getText(), [".","!","?","\n"])

english_dict = Dictionary()
for sentence in sentences:
    # how many words in each sentance
    # print(len(sentence.split())) 
    for word in sentence.split():
        grammar = english_dict.getPartOfSpeech(word) 
        if 'n.' not in grammar and 'v.' not in grammar:
            if 'a.' in grammar:
                print word
                print grammar
                print "it's an article"
                print

