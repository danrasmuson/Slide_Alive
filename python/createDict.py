import pickle
def getDictionaryLines():
    textFile = open("dictionary/dictionaryText.txt","r")
    fullText = textFile.readlines()
    textFile.close()
    return fullText

def isLineDictionaryWord(line):
    if len(line.split()) == 1 and line.isupper():
        if "." not in line: # to avoid defintions
            return True
    else:
        return False

def getPartOfSpeech(index):
    #not this reaches out to dictionary lines
    line = dictionaryLines[index+1]
    sections = line.split()[1:]

    partsOfSpeech = []
    for section in sections:
        # end in n. v. could be one then one in a word
        if section[-1] == '.':
            partsOfSpeech.append(section.strip("\n"))
        else:
            return partsOfSpeech 
    return partsOfSpeech

dictionaryLines = getDictionaryLines()
dictionary = {}

for i in range(0, len(dictionaryLines)):
    line = dictionaryLines[i].strip("\n")
    if isLineDictionaryWord(line):
        # certain words have 2 entries
        # compiling them into the save list
        try:
            values = dictionary[line] # if it doesnt exist will fail

            #todo changes this
            if type(values) != list: 
                dictionary['blahdslfksjadklfjasljdfl']
            dictionary[line].extend(getPartOfSpeech(i))
        except KeyError:
            dictionary[line] = getPartOfSpeech(i)

pickle.dump( dictionary, open( "dictionary/dictionaryPickle.p", "wb" ) )