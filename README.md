# Eigene Alert Meldungen erstellen

![Shopware v6.6.x – v6.7.x](https://img.shields.io/badge/Shopware-v6.6.x--v6.7.x-blue?style=for-the-badge&logo=shopware)
![License](https://img.shields.io/badge/license-MIT-green?style=for-the-badge)

Das Plugin **Rootrifs Custom Alerts** ermöglicht es dir, flexible und dynamische Hinweistexte (Alerts) an verschiedenen strategischen Stellen in deinem Shopware 6 Storefront anzuzeigen. Dank der Integration in den Shopware Rule Builder und der Unterstützung für Verkaufskanäle hast du die volle Kontrolle darüber, welcher Kunde wann welche Information sieht.

## Features

*   **Zentrale Verwaltung:** Eigener Menüpunkt in der Administration unter "Inhalte > Custom Alerts".
*   **Beliebig viele Alerts:** Erstelle so viele Hinweise, wie du für dein Business benötigst.
*   **Flexible Positionierung:** Zeige Alerts an folgenden Stellen an:
    *   Mini-Warenkorb (Offcanvas)
    *   Warenkorb-Seite
    *   Checkout (Bestätigungsseite)
    *   Benutzerkonto (Dashboard)
    *   Produktdetailseite (Buy-Widget)
*   **Rule Builder Integration:** Verknüpfe Alerts mit Regeln, um sie z.B. nur bestimmten Kundengruppen oder ab einem gewissen Warenkorbwert anzuzeigen.
*   **Verkaufskanal-Trennung:** Weise Alerts gezielt einzelnen Verkaufskanälen zu oder schalte sie global für alle Shops frei.
*   **WYSIWYG-Editor:** Gestalte deine Nachrichten mit fetten Texten, Listen oder Links direkt in der Administration.
*   **Mehrsprachigkeit:** Vollständige Unterstützung von Übersetzungen für Überschriften und Nachrichtentexte.
*   **Verschiedene Styles:** Wähle zwischen verschiedenen visuellen Typen (Info, Erfolg, Warnung, Gefahr).

## Installation

1.  Lade das Plugin in das Verzeichnis `custom/plugins/RootrifsCustomAlerts` hoch.
2.  Installiere und aktiviere das Plugin über die Konsole:
    ```bash
    bin/console plugin:refresh
    bin/console plugin:install --activate RootrifsCustomAlerts
    ```
3.  Kompiliere die Administration und das Theme (empfohlen für Shopware 6.6/6.7):
    ```bash
    bin/console asset:install
    bin/console cache:clear
    ```

## Nutzung

1.  Gehe in der Administration zu **Inhalte > Custom Alerts**.
2.  Klicke auf **Alert erstellen**.
3.  Vergib einen **internen Titel** (nur für dich sichtbar) und eine **Überschrift** sowie **Nachricht** für deine Kunden.
4.  Wähle die **Position** und den **Style** (Farbe) des Alerts aus.
5.  Optional: Weise einen **Verkaufskanal** oder eine **Regel** zu, um die Sichtbarkeit einzuschränken.
6.  Setze den Alert auf **Aktiv** und speichere deine Änderungen.

## Technische Details

*   **Datenbank:** Eigene Tabellen `rootrifs_custom_alert` und `rootrifs_custom_alert_translation`.
*   **Technologien:** Nutzt das Shopware DAL (Data Abstraction Layer), Meteor-Admin-Komponenten (Vue 3) und Storefront-Subscriber für maximale Performance.
*   **Kompatibilität:** Optimiert für Shopware 6.6.x und 6.7.x.

## Support

Bei Fragen oder Anpassungswünschen wende dich bitte an:
**Robert Otto**
[https://rootrifs.de](https://rootrifs.de)