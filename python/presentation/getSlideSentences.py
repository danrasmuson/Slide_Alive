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

# for sentence in sentences:
    # how many words in each sentance
    # print(len(sentence.split())) 

print(sentences)