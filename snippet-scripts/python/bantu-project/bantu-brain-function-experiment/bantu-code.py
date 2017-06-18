#### APP INFORMATION ####
# Title         : Bantu Project Experimentation
# Description   : This is an experiment on how a human brain
#                 receive informations, process them and
#                 output result by decision processing methodology
# Version       : 1.0.0
# Author        : Bachot Mpunga
# Author site   : bachotdesign.com
######################################

#### Brain tools ####
sensor_data_capture = {
    "name": "sensor_data_capture",
    "corps" : "touch",
    "nose": "odour",
    "tongue": "taste",
    "eye": "sight",
    "ear": "hearing"
}
brain_hard_drive_memory = {
    "name": "brain_hard_drive",
    "touch_drive" : [{'size':0, 'time':0}],
    "odour_drive": [{'size':0, 'time':0}],
    "taste_drive": [{'size':0, 'time':0}],
    "sight_drive": [{'size':0, 'time':0}],
    "hearing_drive": [{'size':0, 'time':0}],
    "dream": [{'size':0, 'time':0}],
}
brain_processor_decision_making = {
    "name": "brain_processor_decision_making",
    "action": ["get_event", "memorize","remember", "thinking", "forget"],
    "solution_execution_time": ['now', 'later', 'never', 0],
    "decision_making_status": ["slow", "moderate", "fast", 0]
}
#### Brain ####
brain = {
    "name": "brain",
    "item": 1,
    "tools": [sensor_data_capture, brain_hard_drive_memory, brain_processor_decision_making],
    "description": "Manipulate human behaviour",
    "memory_length": ["short_term", "long_term"],
    "shape": "",
    "image":"",
    "video":""
}
#### Body part ####
head = {
    "name": "head",
    "item": 1,
    "tools": ["eye", "ear", "nose", "mouth", brain],
    "description": "The role of the head is to capture data from each of the tool components",
    "shape": "",
    "image":"",
    "video":""
}
middle_body = {
    "name": "body",
    "item": 1,
    "tools": ["neck", "shoulder", "chest", "belly", "west", "sex"],
    "description": "Without body human can not exist",
    "shape": "",
    "image":"",
    "video":""
}
arm = {
    "name": "arm",
    "item": 2,
    "tools": ["arm", "elbow", "forearm", "hand"],
    "description": "The role of the arm is to protect, get, put object and can be use as weapon",
    "shape": "",
    "image":"",
    "video":""
}
leg = {
    "name": "leg",
    "item": 2,
    "tools": ["foot", "kneel", "thigh", "shin", "buttocks", "asshole"],
    "description": "The legs are human transporation tool and weapon",
    "shape": "",
    "image":"",
    "video":""
}

class Human(object):
    def __init__(self, dna_id):
        self.dna = dna_id #unique body identification
        self.body_parts = [head, middle_body, arm, leg] #body part is identified as a set of tools with particular functionality process
    
    def create_human(self):
        print("DNA: " + self.dna + "\n" + "Body parts: ")
        #print(self.body_parts['head'][0])
        print("\n")
        for body_part in self.body_parts:
            print(body_part["name"])
            print(body_part["item"])
            print(body_part["tools"])
            #print(body_part["brain_hard_drive"])
            print("\n")

    def get_event(self):
        count = 0
        while count <= 9:
            print("I am seeing this amount of information", count * 2, ' at this time', count )
            count += 1


male = Human("6789678")
print(male.dna)

print(male.create_human())
print(male.get_event())


