# Nirdeza
=======

![alt tag](https://raw.github.com/achinkulshrestha/The-Web-Panel/master/The-Web-Panel/images/3.PNG)

The emergence of route planning software like Google Maps, Via Michelin, Bing Maps and Directions, Yahoo! Maps and others, opened new vistas to the world of travelling. The magnanimous sphere of knowledge in this field started to shrink by a substantial amount. But as the technology started to pace with an impetuous speed, the requirements of a common user posed new challenges.
Imagine planning a trip to an unfamiliar city with the directions provided by the above mentioned software as your only data. But do you think the information will be sufficient enough? Think Again!!Think about having the advices of those who live in the city at your disposal. Once you have the route, you think is reasonable, you can ask to see what others have to say about that route. The advices of the native people meeting your requirements will help you chose the right options available. 

I thought of creating a system that offered directions as per the advice of the natives of the region to people in finding their way in a new place. For example, the program advises wheelchair accessible roadmap to the differently abled, blind people-friendly roadmap to save them from construction hazards. The program attempts to connect humans with each other at the very core level and not just a map system that directs them virtually.

## Problem Statement

The ordinary maps can show routes and some directions online but think about cases when users plan a trip to an unfamiliar city and require more details. Once they have a route which they think is reasonable, they can ask what others have to say about that route and can get some specific details which they need. We aim to make a route-planning system that allows community input, thus providing extended GIS information. That kind of input will provide a better way of travel and benefit users making them comfortable to travel across new destinations by having the advices and warnings easily available to them.
Our system must provide solutions for the below stated requirements efficiently and easily:
1.  Provide a way to insert Departure and Arrival destination

2. Provide users to choose the type of travel offered by the route-finding tool as
a. Driving
b. Walking
c. Public transportation

3. The system should be able to store and retrieve advices from the users which include the information about the places like dangerous areas, rush-hours, construction hazards, parking places, ATMs, underpasses, and flyovers etc.

4. Registered users have to be able to write advices in multimedia format, including text,   pictures, video, and audio.

5. Users can flag advices as inappropriate to make the system more reliable and authentic.

6. Provide the facility for the disabled and old people to travel through the difficult areas by using advices have certain properties like “wheelchair accessible”, “well lit”, “blind people friendly”, etc.
 
7. Register the users and seek through their personal profile so that advices that fill their needs
    automatically get displayed.

8. Provide users with secure and reliable system as much as possible, so that any fake or wrong advice doesn’t get place on map and cause misguidance.

9. Finds an Optimum route on the basis of Advice Type Selected and calculation through Wilson  Score

10. The System should be compatible on hand held devices running android or Safari operating   Systems.

## General Requirements

In general, users need to know information about places they do not know.
They should have the possibility to choose between different kinds of advices and get information for such category.
Moreover they can add information about known places to help the community. Sometimes users write “bad” or “inappropriate comments, so other users should have the possibility to flag comments and then the administrator can check and remove them.
We want also give the possibility to promote “good” users as moderator, so they can control advices and help the administrator to keep the website clean.

## Use Case Diagram

## Functional Requirements
Functional requirements capture the intended behavior of the system. This behavior may be expressed as services, tasks or functions the system is required to perform. In Nirdeza functional requirements can be divided in groups:
*	Main application core
*	Database
*	Manage application	
*	Web application
Colons can be used to align columns.

### Main application core
Description | Source
--- | ---
Insert Departure and Arrival destination |	Generic User
Users choose type of travel offered by Google (Driving, Walking,Public transportation) |	Generic User
User chooses type of advice (Default user preferred are automatically checked) |	Generic User
### Database
Description | Source
--- | ---
Registered users have to be able to write advices	| Registered User
Users can flag advice as inappropriate |	Registered User
Users can report content (flag and comments) |	Registered User

### Manage application	
Description | Source
--- | ---
Admin has to be able to delete or modify an advice |	Administrator
Admin can promote an user as Moderator |	Administrator
Admin can remove inappropriate users and all their content |	Administrator
Moderator and admin can remove flags if content is ok |	Administrator,Moderator

### Web application	
Description | Source
--- | ---
User should be able to register	| Generic User
Registered users have to be able to do login and logout |	Registered User
	

##Non Functional Requirements
Non-functional requirements or system qualities, capture required properties of the system, such as performance, security, maintainability, scalability, portability etc.-in other words, how well some behavioral or structural aspect of the system should be accomplished

Description | Category
--- | ---
When the user clicks the button search, the system has to respond fast enough |	Performance
The system should work on all the browser |	Portabililty
Every image should have appropriate tags to enhance web accessibility | Maintainence
The system should provide a protection of data held in the database |	Security
A simple user cannot access the administration area |	Security
The system should be able to manage big amount of users and advices |	Scalability

## Context Diagram

## Data Flow Diagrams

## Sequence Diagrams

## Entity Relationship Diagram
