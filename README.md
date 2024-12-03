# Advent of Code 2024

Welcome to my solutions for the Advent of Code 2024 challenges. Each day includes:

- A task description ([Task README](https://github.com/artemii-karkusha/aoc-2024/day-{n}/README.md))
- Input data
- Solution implementation
- Optionally: a solution explanation diagram ([View Diagram](https://app.eraser.io/workspace/cglHEErH2vTHdJEmVLeC?origin=share))

---

## Repository Structure

- `src/`: Shared utilities and functionality used across multiple days.
- `day-{n}/`: Contains day-specific solutions:
    - `README.md`: Task description and notes.
    - `src/solution.php`: Solution code.
    - `data/input-data.txt`: Puzzle input data.
    - `vendor/`: Composer dependencies.
- `vendor/`: Composer dependencies.

## Install

Run the following command to install dependencies:

```bash
  composer install
```

## Usage

Run the solution for a specific day using Composer scripts:

```bash
  composer run-script execute-day-{n}
```


## Daily Challenges

### Day 1

[Task README](https://github.com/artemii-karkusha/aoc-2024/day-1/README.md)

[Solution Explanation Diagram](https://app.eraser.io/workspace/cglHEErH2vTHdJEmVLeC?origin=share)


### Day 2

[Task README](https://github.com/artemii-karkusha/aoc-2024/day-2/README.md)


## Acknowledgments

- [Advent of Code](https://adventofcode.com) for the puzzles.
- [PHP_CodeSniffer](https://github.com/PHPCSStandards/PHP_CodeSniffer/) for code quality checks.