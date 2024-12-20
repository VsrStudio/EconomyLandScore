# EconomyLandScore

**EconomyLandScore** is a plugin for PocketMine-MP that integrates with **EconomyLand** and **ScoreHud** to display the player's land information on the scoreboard. It shows the land name where the player is currently located.

## Features

- Displays the current land name the player is in using **ScoreHud**.
- Automatically updates the land information for all players every 5 seconds.
- Compatible with **EconomyLand** and **ScoreHud** plugins.

## Requirements

- PocketMine-MP API 5.0.0 or higher
- **[EconomyLand](https://github.com/ACM-PocketMine-MP/EconomyLand)** plugin
- **[ScoreHud](https://github.com/Ifera/ScoreHud)** plugin

## Configuration

Once installed, you can add the following tag to your **ScoreHud** configuration file to display the land name:

```yaml
scoreboard:
  title: "Land Info"
  lines:
    - "Land: {economyland.score}"
```
```yaml
{economyland.score}
```
