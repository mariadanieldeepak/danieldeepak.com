---
title: "Microsoft-in-campus Session On Power BI [Part 2]"
date: "2016-05-20T03:30:29Z"
description: "Meet the cloud based analytics and visualization tool from Microsoft – Power BI. Power BI is a easy-to-use self-service business intelligence tool."
---

This post is a part of the series called Microsoft-in-campus session on Power BI.

- [Microsoft-in-campus Session On Power BI – Sharing My Insights](/blog/msft-powerbi-session-introduction/)
- [Microsoft-in-campus Session On Power BI [Part 1]](/blog/msft-power-bi-session-part-1/)
- Microsoft-in-campus Session On Power BI [Part 2]
- [Microsoft-in-campus Session On Power BI [Part 3]](/blog/microsoft-campus-session-power-bi-part-3/)
- Microsoft-in-campus Session On Power BI [Part 4]

## Data source and Dataset

We can create powerful visualizations and reports using Power BI when we connect to data. Each time we connect Power BI to a data source, a dataset is created.

A **dataset** contains information about the data source, its credentials etc. A **data source** can
 be anything ranging from a simple csv file to an on premise enterprise database.

A data source is where the data in a dataset really comes from.

Let us see the different data sources that Power BI can connect to.

**1. Files**

You can connect variety of file types such as csv, excel, txt files to Power BI and draw insights using the data from the files.

**2. Databases**

Power BI has the potential to connect to both on premise databases and to the cloud databases. The real advantage of connecting to cloud databases is that the connection is live. This is really useful as the data is being queried from the database as we start creating visualizations and reports.

The speaker emphasized on real-time connection and live connection at this point. Power BI supports live connection which means the data might be few minutes older than the data in the database unlike the real-time connection.

The speaker also mentioned that Power BI is an in-memory tool and the amount of data it holds for processing is only limited by the machine on which Power BI is accessed.

**3. - Other Data Sources**

With Power BI you can connect to number of online services such as Facebook, Google Analytics, Salesforce Reports, Zendesk etc. and draw insights.

Microsoft continuously builds connectors to connect to variety of online services making it 
easier for the users. Users are provided with ([service content packs](https://powerbi.microsoft.com/en-us/documentation/powerbi-service-get-data/#content-packs)) pre built reports and they’re literally ready to go once they connect to a service.

## Content Packs

In order to understand what content packs really are, we need to understand datasets, reports and dashboards.

**Content pack** is a simple way to organized and package datasets, reports and dashboards together 
into a single entity. We shall be discussing about reports and dashboards in the next blog post. This is little weird but this is how the session was organized.

There are two types of content packs – Services and Organizational. Learn more about the [types 
of content packs](https://powerbi.microsoft.com/en-us/documentation/powerbi-service-get-data/#content-packs).

**Organizational content pack** - Assume that the sales reports of an Organization have to be shared
 within the Sales management folks within the organization. Rather than sending individual reports separately, the reports and the corresponding datasets can be bundled together as an Organizational content pack and can be shared across the sales team.

Learn more about [life cycle of an Organizational content pack](https://powerbi.microsoft
.com/en-us/documentation/powerbi-service-organizational-content-packs-introduction/#the-life-cycle-of-an-organizational-content-pack) and about [data security](https://powerbi.microsoft.com/en-us/documentation/powerbi-service-organizational-content-packs-introduction/#data-security).

## Personal Gateways

Power BI Personal gateway acts as a bridge to securely transfer data between on premise data source and Power BI service.

Power BI personal gateway comes only with the Power BI Pro version. The data transfer is secured through the Azure service bus and prevents the need to open additional ports in Windows Firewall.

Personal Gateways can be run either as a service or as an application in Windows machines. Personal gateways are used with data sources that supports refresh.

Learn more about installing and setting up [personal gateway](https://powerbi.microsoft.com/en-us/documentation/powerbi-personal-gateway/).

The speaker concluded the second session with the above mentioned topics. Stay tuned for the upcoming sessions, as there are demos presented.